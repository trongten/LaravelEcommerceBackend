@extends('layouts.default')
@section('content')
<div>
        <div class="form-group">
            <label for="id">Id</label>
            <input type="text" readonly required name="id" value="{{ $noctice->id }}" class="form-control" id="title"
               >
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" readonly required name="title" value="{{ $noctice->title }}" class="form-control" id="title"
                >
        </div>
        <div class="form-group">
            <label for="detail">Detail</label>
            <input type="text" readonly required name="detail" value="{{ $noctice->detail }}" class="form-control" id="content" value="{{ $noctice->content }}">
        </div> 
        <div>
            Receiver:
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
</div>

@endsection