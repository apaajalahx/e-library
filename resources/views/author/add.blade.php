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
<form action="{{ route('author') }}/store" method="POST">
@csrf
<p><strong>Author Name : </strong></p>
<input class="form-control" type="text" name="author_name" placeholder="Author Name">
<br><p></p>
<button class="btn btn-secondary" type="submit">Submit</button><a href="{{route('author')}}" class="btn btn-info">Back</a>
</form>
</div>
@endsection