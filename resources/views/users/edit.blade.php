@extends("layouts.app")

@section("content")
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    @foreach($users as $user):
    <form action="{{ route('user_edit_post') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $user->id }}">
    <p><strong>Input Your Name</strong></p>
    <input class="form-control" value="{{ $user->name }}" placeholder="Name" type="text" name="name" required>
    <p><strong>Input Your Email</strong></p>
    <input class="form-control" value="{{ $user->email }}" placeholder="email@example.com" type="text" name="email" required>
    <p><strong>Select Role User</strong></p>
    <select name="role" class="form-select">
        <option value="admin">Admin</option>
        <option value="users">users</option>
    </select>
    <br>
    <p><strong>Input Your Password</strong></p>
    <input class="form-control" type="password" name="password">
    <p><strong>Retype Your Password</strong></p>
    <input class="form-control" type="password" name="pre-password">
    <br>
    <button type="submit" class="btn btn-secondary">Edit Users</button>
    </form>
    @endforeach

@endsection