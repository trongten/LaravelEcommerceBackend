@extends('layouts.default')
@section('content')
    <h2 class="text-center mt-4 mb-4">USER LIST</h2>
    <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Add user</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">role</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ get_role_name_by_id($user->role_id) }}</td>
                    <td>
                        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-warning mb-3">Edit</a>
                        <form method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
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
