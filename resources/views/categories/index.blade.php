@extends('layouts.default')
@section('content')
    <h2 class="text-center mt-4 mb-4">CATEGORIES LIST</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add category</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">description</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                    
                    <td>
                        <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-warning mb-3">Edit</a>
                        <form method="POST" action="{{ route('categories.destroy', ['category' => $category->id]) }}">
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
