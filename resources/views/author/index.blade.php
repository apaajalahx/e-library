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
<a href="{{ route('author') }}/add" class="btn btn-secondary">Add New Author</a>
</font>
<div class="table-responsive">
    <table class="table table-sm table-hover ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td><a class="btn btn-primary" href="{{route('author')}}/edit/{{ $author->id }}">Edit</a> | <a class="btn btn-danger" href="{{route('author')}}/delete/{{ $author->id }}">Delete</a></td>
            </tr>
            @endforeach
        </tbody>
    {{$authors->links()}}
    </table>
</div>
@endsection