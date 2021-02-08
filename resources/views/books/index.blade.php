@extends("layouts.app")

@section("content")
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
<font size="10"><strong>List Book</strong>
@if(Level::where("users_id",Auth::user()->id)->first()->level_name == "admin")
<a href="{{ route('books') }}/add" class="btn btn-secondary">Add New Book</a>
@endif
</font>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Download Link</th>
            @if(Level::where("users_id",Auth::user()->id)->first()->level_name == "admin")
            <th>Action</th>
            @endif
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
            @if(Level::where("users_id",Auth::user()->id)->first()->level_name == "admin")
                <td><a class="btn btn-primary" href="{{route('books')}}/edit/{{ $book->id }}">Edit</a> | <a class="btn btn-danger" href="{{route('books')}}/delete/{{ $book->id }}">Delete</a></td>
            @endif
        </tr>
        @endforeach
    </tbody>
</table>
@endsection