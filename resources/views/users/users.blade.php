@extends("layouts.app")

@section("content")
@if (\Session::has('deleted'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('deleted') !!}</li>
            </ul>
        </div>
    @endif
<a href="{{ route('useradd') }}" class="btn btn-secondary">ADD NEW</a>
<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td><a class="btn btn-primary" href="user_edit/{{ $user->id }}">Edit</a> | <a class="btn btn-danger" href="user_delete/{{ $user->id }}">Delete</a></td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $users->links() }}
@endsection