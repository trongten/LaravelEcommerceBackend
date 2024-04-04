@extends('layouts.default')

@section('content')
    <div class="m-5">
        <form method="POST" action="{{route('products.update', ['product' => $product->id])}}">
            @method('put')
            {!! csrf_field() !!}
            <div class="form-group">
                <label for="title">name</label>
                <input type="text" name="name"  value="{{ $product->name }}" class="form-control" id="title"
                    aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="content">price</label>
                <input type="text" name="price" value="{{ $product->price }}" class="form-control" id="content">
            </div>
            <div class="form-group">
                <label for="content">image</label>
                <input type="text" name="image" value="{{ $product->image }}" class="form-control" id="content">
            </div>
            <div class="form-group">
                <label for="content">rate</label>
                <input type="text" name="rate" value="{{ $product->rate }}" class="form-control" id="content">
            </div>
            <div class="form-group">
                <label for="content">count</label>
                <input type="text" name="count" value="{{ $product->count }}" class="form-control" id="content">
            </div>
            <div class="form-group">
                <label for="content">description</label>
                <input type="text" name="description" value="{{ $product->description }}" class="form-control" id="content">
            </div>
            
            <div class="form-group">
                <label for="content">description</label>
                <select class="form-control" id="category_id" name="category_id">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
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
