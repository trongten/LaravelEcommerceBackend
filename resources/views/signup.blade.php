@extends('layouts.empty')
@section('content')
        <br>
        <h1 class="text-center">Sign Up</h1>
        <div class="row" ><div class="col-4" > </div>
                <form class="form col-4" method="POST" action="/handle_signup">
                    {!! csrf_field() !!}
                   
                    <div class="form-group">
                        <label for="name">Name</label> 
                        <input class="form-control" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" >
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" type="password" name="password" required>
                        @error('password')
                            <span>{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" required>
                    </div>
                    
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Register</button>
                    </div>
                    <br>
                    <a href="/login">Login now !</a>
                </form><div class="col-4" > </div>
            </div>
    </div>
@endsection
