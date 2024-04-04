@extends('layouts.default')
@section('content')
    <h2 class="text-center mt-4 mb-4">NOCTICE LIST</h2>
    <a href="{{route('noctices.create')}}" class="btn btn-primary mb-3">Add noctice</a>
    <table id="noctices" class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($noctices as $noctice)
                <tr>
                    <th scope="row">{{ $noctice->id }}</th>
                    <td>{{ $noctice->title }}</td>
                    <td>{{ $noctice->created_at }}</td>
                    <td>{{ $noctice->updated_at }}</td>
                    <td>
                      <a href="{{route('noctices.edit', ['noctice' => $noctice->id])}}" class="btn btn-warning mb-3">Edit</a>
                      <a href="{{route('noctices.show', ['noctice' => $noctice->id])}}" class="btn btn-success mb-3">Show</a>
                      <form method="POST" action="{{route('noctices.destroy', ['noctice' => $noctice->id])}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>$(document).ready(function () {
        $('#noctices').DataTable();
      });</script>
@endsection