@extends('layouts.default')

@section('content')
    <div class="m-5">
        <form method="POST" action="{{route('noctices.update', ['noctice' => $noctice->id])}}">
            @method('put')
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{$noctice->title}}" class="form-control" id="title"
                    required>
            </div>
            <div class="form-group">
                <label for="detail">Detail</label>
                <input type="text" name="detail" value="{{$noctice->detail}}" class="form-control" id="detail" required>
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
                    @if (in_array($user,$userNoctice))
                    <input type="checkbox" name="users[]" value="{{$user['id']}}" checked> <label for="{{$user['email']}}">{{$user['email']}}</label>   
                    @else
                    <input type="checkbox" name="users[]" value="{{$user['id']}}" > <label for="{{$user['email']}}">{{$user['email']}}</label>   
                    @endif
                    &emsp13; 
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
@endsection
