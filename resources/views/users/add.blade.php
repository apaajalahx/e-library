@extends("layouts.app")

@section("content")
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <form action="{{ route('user_add') }}" method="post">
    @csrf
    <p><strong>Input Your Name</strong></p>
    <input class="form-control" placeholder="Name" type="text" name="name" required>
    <p><strong>Input Your Email</strong></p>
    <input class="form-control" placeholder="email@example.com" type="text" name="email" required>
    <p><strong>Select Role User</strong></p>
    <select name="role" class="form-select">
        <option value="admin">Admin</option>
        <option value="users">users</option>
    </select>
    <p><strong>Input Your Password</strong></p>
    <input class="form-control" type="password" name="password" required>
    <p><strong>Retype Your Password</strong></p>
    <input class="form-control" type="password" name="pre-password" required>
    <br>
    <button type="submit" class="btn btn-secondary">ADD Users</button>
    </form>
@endsection