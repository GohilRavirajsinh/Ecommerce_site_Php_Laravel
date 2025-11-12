@extends('layouts.layout')
@section('content')
<form method="POST" action="{{ route('admin.authenticate') }}">
    @csrf
    <label>Email:</label>
    <input type="email" name="email" required>
    <label>Password:</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
@endsection