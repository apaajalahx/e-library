@extends('layouts.app')
@section('content')
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
<div class="container">
<form enctype="multipart/form-data" action="{{ route('books_update') }}" method="POST">
@csrf
<p><strong>Title</strong></p>
<input class="form-control" type="text" name="title" value="{{ $books->title }}">
<p><strong>Description</strong></p>
<input class="form-control" type="text" name="description" value="{{ $books->description }}">
<p><strong>Select Author</strong></p>
<select class="form-control" id="select" class="select" name="author_id[]" style="width:25%;" multiple>
@foreach($authors as $author)
    <option value="{{ $author->id }}">{{ $author->name }}</option>
@endforeach
</select>
<p>Lates File : <a href="{{ asset($books->pdf) }}">Downlad</a></p>
<p><strong>Only: pdf</strong></p>
<input class="form-control" type="file" name="pdf">
<input type="hidden" name="id" value="{{ $books->id }}">
<br><p></p>
<button class="btn btn-secondary" type="submit">Submit</button><a href="{{route('books')}}" class="btn btn-info">Back</a>
</form>
</div>
<script>
        $(function() {
            $('#select').selectize();
        });
    </script>
@endsection