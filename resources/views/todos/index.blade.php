@extends('layouts.default')
@section('content')
    <h2 class="text-center mt-4 mb-4">TODO LIST</h2>
    <a href="{{route('todos.create')}}" class="btn btn-primary mb-3">Add todo</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Content</th>
                <th scope="col">User</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($todos as $todo)
                <tr>
                    <th scope="row">{{ $todo->id }}</th>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->content }}</td>
                    <td>{{ get_user_name_by_id($todo->user_id) }}</td>
                    <td>
                      <a href="{{route('todos.edit', ['todo' => $todo->id])}}" class="btn btn-warning mb-3">Edit</a>
                      <form method="POST" action="{{route('todos.destroy', ['todo' => $todo->id])}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection