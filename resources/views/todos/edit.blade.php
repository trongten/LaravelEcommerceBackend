@extends('layouts.default')

@section('content')
    <div class="m-5">
        <form method="POST" action="{{route('todos.update', ['todo' => $todo->id])}}">
            @method('put')
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ $todo->title }}" class="form-control" id="title"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" name="content" class="form-control" id="content" value="{{ $todo->content }}">
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
