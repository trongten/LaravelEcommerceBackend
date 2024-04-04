@extends('layouts.default')
@section('content')
    <h2 class="text-center mt-4 mb-4">PRODUCT LIST</h2>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add product</a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">name</th>
                <th scope="col">price</th>
                <th scope="col">image</th>
                <th scope="col">rate</th>
                <th scope="col">count</th>
                <th scope="col">description</th>
                <th scope="col">category</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <img  width="50" height="50" src="{{ $product->image }}" alt="">
                    </td>
                    <td>{{ $product->rate }}</td>
                    <td>{{ $product->count }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->category_name }}</td>
                    
                    <td>
                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="btn btn-warning mb-3">Edit</a>
                        <form method="POST" action="{{ route('products.destroy', ['product' => $product->id]) }}">
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
