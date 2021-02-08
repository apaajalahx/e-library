@extends('layouts.app')

@section('content')
<table class="table table-hover table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Author</th>
                <th>Download Link</th>
            </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->description }}</td>
                <td>@foreach($book->author as $author)
                        [ {{ $author->name }} ]
                    @endforeach</td>
                <td><a class="btn btn-info" href="{{ asset($book->pdf) }}">Download</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection