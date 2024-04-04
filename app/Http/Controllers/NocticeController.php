<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\NoticeEmail;
use Illuminate\Http\Request;
use App\Models\Noctice;
use App\Models\NocticeDetail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NocticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noctices = Noctice::get();
        return view("noctices.index",compact('noctices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $users = User::get();
        return view("noctices.create",compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        //danh sach user nhan thong bao
        $users_id = $request->users;

        $noctice=[
            'title'=>$request->title,
            'detail'=>$request->detail
            ];

        $noctice = Noctice::create($noctice);
        $users = $this->handleNocticeDeltailbyUserIds($users_id,function($user_id)use($noctice){
            NocticeDetail::insert([
                'noctice_id'=>$noctice->id,
                'user_id'=>$user_id
            ]);
        });
        SendEmail::dispatch($noctice,$users)->delay(now()->addMinute(1));
        
        return redirect()->action([NocticeController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noctice = Noctice::find($id);
        $nocticeDetails = NocticeDetail::where('noctice_id','=',$id)->get();
        $users =$this->getUserByNocticeDetail($nocticeDetails);
        return view('noctices.show',compact(['noctice','users']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noctice = Noctice::find($id);
        $nocticeDetails = NocticeDetail::where('noctice_id','=',$id)->get();
       
        $userNoctice =$this->getUserByNocticeDetail($nocticeDetails)->toArray();
        $users = User::get()->toArray();
        return view("noctices.edit",compact(['noctice','users','userNoctice']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $noctice = Noctice::find($id);
        $noctice->title = $request->title;
        $noctice->detail = $request->detail;
        $noctice->save();


        $users_id = $request->users;
        NocticeDetail::where('noctice_id',$id)->delete();
        $users = $this->handleNocticeDeltailbyUserIds($users_id,function($user_id)use($noctice){
            NocticeDetail::insert([
                'noctice_id'=>$noctice->id,
                'user_id'=>$user_id
            ]);
        });
        SendEmail::dispatch($noctice,$users)->delay(now()->addMinute(1));
        return redirect()->action([NocticeController::class,'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        NocticeDetail::where('noctice_id',$id)->delete();
        Noctice::destroy($id);

        return redirect()->action([NocticeController::class,'index']);
    }


    protected function getUserByNocticeDetail($nocticeDetails)
    {
        $query = User::query();
        foreach ($nocticeDetails as $nocticeDetail) {
            $query->orWhere('id','=',$nocticeDetail->user_id);
        }
        return $query->get();
    }


    
    protected function handleNocticeDeltailbyUserIds($users_id,$callback)
    {
        $query = User::query();
        foreach ($users_id as $user_id) {
            $callback($user_id);
            $query->orWhere('id','=',$user_id);
        }
        return $query->get();
    }

}
