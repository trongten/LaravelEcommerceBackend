@extends('layouts.default')

@section('content')
    <div class="m-5">
        <form method="POST" action="/categories">
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="title">name</label>
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="title"
                    aria-describedby="emailHelp">
            </div>
            
            <div class="form-group">
                <label for="content">description</label>
                <input type="text" name="description" class="form-control" id="content">
            </div>
            
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                @endforeach
            @endif

            @if (Session::has('error'))
                <div class="text-danger">{{ Session::get('error') }}</div>
            @endif
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
@endsection
