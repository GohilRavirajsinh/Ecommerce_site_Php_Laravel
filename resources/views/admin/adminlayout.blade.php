<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('admin.dashboard') }}">Dashboard</a>
        <a href="{{ url('login') }}">Logout</a></div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>