<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Jobs\SendOrderEmail;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\User;
use PDF;
use Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use PHPViet\NumberToWords\Transformer;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

      //Sort
        if ($request->has('create_at')) {
            $sort = $request->input('sort');
            if ($sort == 'create_at_asc') {
                $query->orderBy('create_at', 'asc');
            } elseif ($sort == 'create_at_desc') {
                $query->orderBy('create_at', 'desc');
            }
        }

        // Paginate
        $perPage = $request->has('per_page') ? $request->input('per_page') : 10;
        $orders = $query->paginate($perPage);

        foreach ($orders as $order) {
            $order->details = $this->getOrderDetailandPopulateProduct($order->id);
        }
        return response()->json($orders);
    }   


    public function add(OrderRequest $request)
    {  //validate
        $validated = $request->validated();
        //get user info
        $user = Auth::user();
        //check count and calculate total price
        $price = 0;
        foreach ($validated['details'] as $product) {
            $productI = Product::find($product['product_id']);
            
            if($productI->count < $product['count']){
                return response()->json([
                    'msg' => 'product_id: '.$product['product_id'].' is invalid count'
                ], 401);
            }
            $price += $productI->price * $product['count'];
        }
        //transaction
        DB::beginTransaction();
        try {
            // create order
            $order = Order::create([
                'user_id' => $user->id,
                'price' => $price,
            ]);
            //create ordel deltail
            foreach ($validated['details'] as $product) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'count' => $product['count'],
                ]);
                //the number of products left 
                $products = Product::find($product['product_id']);
                $products->count =$products->count - $product['count'];
                $products->save();
            }

            $order->details = $validated['details'];
            DB::commit();    
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'msg' => 'create order failed'
            ], 501);
       }
       
        $order->details = $this->getOrderDetailandPopulateProduct($order->id);

        return response()->json([
            'msg' => 'create order successfully',
            'data' => $order
        ], 201);
    }

    public function update(OrderRequest $request, $id)
    {
        //validate
        $validated = $request->validated();

        //Old OrderDetail
        $oldOrderDetail = OrderDetail::where('order_id', $id);

        //check count and calculate total price
        $price = 0;
        foreach ($validated['details'] as $product) {
            $productI = Product::find($product['product_id']);
            $count=$oldOrderDetail->where('product_id',$product['product_id'])->first()->count;
            if($productI->count < ($product['count']-$count)){
                return response()->json([
                    'msg' => 'product_id: '.$product['product_id'].' is invalid count'
                ], 401);
            }
            $price += $productI->price * $product['count'];
        }

        
        //transaction
        DB::beginTransaction();
        try {

            //Delete old OrderDetail
            foreach ($oldOrderDetail->get() as $orderDetail) {
                $product = Product::find($orderDetail->product_id);
                $product->count = $product->count+$orderDetail->count;
                $product->save();
            }
            OrderDetail::where('order_id',$id)->delete();
          
            //update new order deltail
            foreach ($validated['details'] as $product) {
                OrderDetail::create([
                    'order_id' => $id,
                    'product_id' => $product['product_id'],
                    'count' => $product['count'],
                ]);
                //the number of products left 
                $products = Product::find($product['product_id']);
                $products->count =$products->count - $product['count'];
                $products->save();
            }

            DB::commit();    
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'msg' => 'update order failed'
            ], 501);
       }
        
        return response()->json([
            'msg' => 'update order successfully',
            'data' => [
                'order_id'=>$id,
                'details'=> $validated['details']
            ]
        ], 201);


    }

    public function destroy($id)
    {
        //Old OrderDetail
        $oldOrderDetail = OrderDetail::where('order_id', $id);
        
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'msg' => 'order is not found'
            ], 404);
        }
        try {
            //Delete old OrderDetail
            foreach ($oldOrderDetail->get() as $orderDetail) {
                $product = Product::find($orderDetail->product_id);
                $product->count = $product->count+$orderDetail->count;
                $product->save();
            }
            OrderDetail::where('order_id',$id)->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'delete order failed',
            ], 501);
        }
       

        return response()->json([
            'msg' => 'delete order successfully',
        ], 200);
    }

    public function getOrderDetailandPopulateProduct($id)
    {
        $orderDetails = OrderDetail::where('order_id', $id)
            ->select('order_details.product_id','order_details.count')
            ->get();
            foreach ($orderDetails as $orderDetail) {
                $product = Product::find($orderDetail->product_id);
                unset($orderDetail['product_id']);
                $orderDetail->product = $product;
            }
        return $orderDetails;
    }


    public function updateStateOrder(Request $request,$id)
    {   
        


        $order = Order::find($id);
        //get user info
        $user = User::find($order->user_id);
        if (!$order) {
            return response()->json([
                'msg' => 'order is not found'
            ], 404);
        }
        $order->update(['state'=>$request->state]);
        
        //Nhung thong tin product vao order
        $order->details = $this->getOrderDetailandPopulateProduct($order->id);


        //send PDF
        $this->sendPDFFile($order,$user);
        
        return response()->json([
            'msg' => 'update state order successfully',
        ], 200);
    }

    public function sendPDFFile($order,$user)
    {   //tao file pdf
        $transformer = new Transformer();
        PDF::setOption(['dpi' => 150, 'defaultFont' => 'Roboto']);
        $priceString =  $transformer->toCurrency($order->price);
        $pdf = PDF::loadView('pdfs.order',compact('order','user','priceString'));
        $pdfPath = 'pdf/' . 'Order-' . Str::random(40) . '.pdf';
        Storage::put($pdfPath, $pdf->output());
        //Gui email
        SendOrderEmail::dispatch($order,$user,$pdfPath)->delay(now()->addMinute(1));
        //Sau khi gui thi xoa 
    }


    
}
