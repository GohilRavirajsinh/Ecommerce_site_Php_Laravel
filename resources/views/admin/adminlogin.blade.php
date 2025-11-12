@extends('admin.adminlayout')
@section('content')
<div class="login-container">
    <h2>Admin Login</h2>
    <form method="POST" action="{{ route('admin.authenticate') }}">
        @csrf
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button>
    </form>
</div>
@endsection