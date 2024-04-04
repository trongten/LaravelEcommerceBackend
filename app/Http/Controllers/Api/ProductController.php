<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::query();

    // Search
    if ($request->has('name')) {
        $query->where('name', 'like', '%'.$request->input('name').'%');
    }
    if ($request->has('sort')) {
        $sort = $request->input('sort');
        if ($sort == 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort == 'name_desc') {
            $query->orderBy('name', 'desc');
        } elseif ($sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        }
    }

    // Paginate
    $perPage = $request->has('per_page') ? $request->input('per_page') : 10;
    $products = $query->paginate($perPage);

    return response()->json($products);
    }


    public function add(CreateProductRequest $request)
    {
        $validated = $request->validated();
        $validated['rate']=0;
        Product::insert($validated);

        return response()->json([
            'msg' => 'create product successfully',
            'data' => $validated
        ], 201);
    }

    
    public function update(CreateProductRequest $request, $id)
    {
        $product = Product::find($id);
        $validated = $request->validated();
        if (!$product) {
            return response()->json([
                'msg' => 'product is not found'
            ], 404);
        }

        $product->update($validated);

        return response()->json([
            'message' => 'update product successfully',
            'data' => $product
        ], 200);
    }

    
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'msg' => 'product is not found'
            ], 404);
        }

        try {
            $product->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => 'product in use'
            ], 401);
        }

        return response()->json([
            'msg' => 'delete product successfully',
        ], 200);
    }
}
