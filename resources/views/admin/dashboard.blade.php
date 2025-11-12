@extends('admin.adminlayout')
@section('content')
<div class="dashboard">
    <h1>Admin Dashboard</h1>
    <div class="grid-container">
        <div class="card"><a href="{{ url('/admin.users') }}">Manage Users</a></div>
        <div class="card"><a href="{{ url('admin.products') }}">Manage Products</a></div>
        <div class="card"><a href="{{ url('admin.affiliate_links') }}">Manage Affiliate Links</a></div>
        <div class="card"><a href="{{ url('admin.orders') }}">Check Orders</a></div>
        <div class="card"><a href="{{ url('admin.transactions') }}">Transactions</a></div>
    </div>
</div>
@endsection
