<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserSignUp;
use App\Models\User;
use Illuminate\Http\Request;

use Auth;
use Laravel\Socialite\Facades\Socialite;
use Str;

class AuthController extends Controller
{
  public function signup()
  {
    return view('signup');
  }

  public function handle_signup(UserSignUp $request)
  {
    $validated = $request->validated();
    $user = [
      "email"=>$validated['email'],
      "password"=>$validated['password']
    ];

    $validated['password'] = bcrypt($validated['password']);
    $validated['role_id']=2;
    User::insert($validated);

    if (Auth::attempt($user)) {
      return redirect()->intended('/todos');
    }
    
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);

  }

    /**
     * Display login ui
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('login');
    }

    public function login(Request $request) 
    {
      
      $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/');
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
    }


    public function logout(Request $request) 
    {
      Auth::logout();
      return redirect('/login');
    }
  

    public function redirectGoogleAuth(Request $request) 
    {
      return Socialite::driver('google')->redirect();
    }
  

    public function handleGoogleCallback(Request $request) 
    {
      try {
        $user = Socialite::driver('google')->user();
      } catch (\Throwable $th) {
        return redirect('/login')->withErrors([
          'email' => 'Login with Google failer',
      ]);
      }
     
      $userModel = User::where('email', $user->getEmail())->first();
      if (!$userModel) {
          $userModel=User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(Str::random(8)),
                'role_id' =>2,
                 
          ]);
      }
      Auth::login($userModel);
      return redirect()->intended('/products');
    }

    public function redirectFacebookAuth(Request $request) 
    {
      return Socialite::driver('facebook')->redirect();
    }
  

    public function handleFacebookCallback(Request $request) 
    {
      try {
        $user = Socialite::driver('facebook')->user();
      } catch (\Throwable $th) {
        return redirect('/login')->withErrors([
          'email' => 'Login with Facebook failer',
      ]);
      }
      
      $userModel = User::where('email', $user->getEmail())->first();
      if (!$userModel) {
          $userModel=User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt(Str::random(8)),
                'role_id' =>2,
                 
          ]);
      }
      Auth::login($userModel);
      return redirect()->intended('/products');
    }

}
