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
<form action="{{ route('author') }}/update" method="POST">
<p><strong>Author Name : </strong></p>
@csrf
<input type="hidden" name="id" value="{{ $author->id }}">
<input class="form-control" type="text" name="author_name" value="{{ $author->name }}">
<br><p></p>
<button class="btn btn-secondary" type="submit">Submit</button><a href="{{route('author')}}" class="btn btn-info">Back</a>
</form>
</div>
@endsection