@extends('layouts.default')

@section('content')
    <div class="m-5">
        <form method="POST" action="/admin/noctices">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control" id="title"
                    aria-describedby="emailHelp" required>
            </div>
            <div class="form-group">
                <label for="detail">Detail</label>
                <input type="text" name="detail" class="form-control" id="detail" required>
            </div>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                @endforeach
            @endif
            @if (Session::has('error'))
                <div class="text-danger">{{ Session::get('error') }}</div>
            @endif

            User:
            <div>
                @foreach ($users as $user)
               
                        <input type="checkbox" name="users[]" id={{$user->email}} value="{{$user->id}}" checked> <label for="{{$user->email}}">{{$user->email}}</label>
                        &emsp13; 
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
@endsection
