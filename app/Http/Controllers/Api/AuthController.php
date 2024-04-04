<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserSignUp;
use App\Http\Requests\UserLogin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function signup(UserSignUp $request)
    {
       $validated = $request->validated();
       $validated['password'] = bcrypt($validated['password']);
       $validated['role_id']=2;
       $user = User::insert($validated);
       return response()->json(["msg"=>"Sign up success"],200);
    }
    
    public function login(UserLogin $request)
    {
       $validated = $request->validated();
       if(Auth::attempt($validated)){
            $user = Auth::user();
            $token=Auth::user()->createToken('Laravel')->accessToken;

            return response()->json([
                'user'=>$user,
                'token' =>$token,
                'msg'=>'login success'],200);

       }else{
            return response()->json(['msg'=>'email or password invalid'],200);
       }
    }

    public function getInfo(){
        $user = Auth::user();
        return response()->json([
            'user'=>$user,
        ],200);
    }
   
    public function unauth()
    {
       return response()->json(["msg"=>"unaauthcaited"],401);
    }
}