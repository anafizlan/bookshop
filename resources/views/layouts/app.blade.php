<!DOCTYPE html>
<html>
<head>
    <title>My App</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body>

<nav style="padding:10px; background:#333;">
    <a href="/" class="home">Home</a>
    <a href="/users" class="home">Users</a>
</nav>

<hr>

@yield('content')

</body>
</html>
