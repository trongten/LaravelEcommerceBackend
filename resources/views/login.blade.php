@extends('layouts.empty')
@section('content') 
    <br>
   <h1 class="text-center">Login</h1>
    <div class="row" ><div class="col-4" > </div>
        <div class="col-4"><form class="form " method="POST" action="/login">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                @endforeach
            @endif
            @if (Session::has('error'))
                <div class="text-danger">{{ Session::get('error') }}</div>
            @endif
            <div>
                <button type="submit" class="col-12 btn btn-primary mt-4">Login</button>
            </div>
        </form>
        
        <div class="text-center"><br><br>
            <h5>Login with</h5>
           <a href="/auth/google/redirect" class="btn border mt-4 col-4">Google</a>
            
            <a href="/auth/facebook/redirect" class="btn border mt-4 col-4">Facebook</a>
        </div>
        
        <br><br>
        <div class="col-12 text-center"><a  href="/signup">Sign up now !</a></div>
        
    </div>
        <div class="col-4" > </div>
    </div>
@endsection
