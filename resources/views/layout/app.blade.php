<!DOCTYPE html>
<html>
<head>
    <title>Bank System</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

<nav>
<a href="/register">Register</a>
<a href="/login">login</a>

@csrf
<form method="POST" action="/logout">@csrf<button>Logout</button></form>
</nav>
@yield('content')

</body>
</html>
