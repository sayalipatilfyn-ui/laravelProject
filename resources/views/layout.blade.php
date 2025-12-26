<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Bank Management System')</title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }
        .hero {
            background: linear-gradient(135deg, #0d6efd, #084298);
            color: white;
            padding: 80px 20px;
            border-radius: 10px;
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">🏦 BankSys</a>
        <div>
            <a href="/login" class="btn btn-light btn-sm">Login</a>
            <a href="/register" class="btn btn-outline-light btn-sm ms-2">Register</a>
        </div>
    </div>
</nav>

<div class="container mt-4">
    @yield('content')
</div>

<footer class="text-center mt-5 mb-3 text-muted">
    © {{ date('Y') }} Bank Management System 
</footer>

</body>
</html>
