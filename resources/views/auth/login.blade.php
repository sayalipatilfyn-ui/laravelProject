@extends('layout')

@section('title', 'Login')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header text-center bg-primary text-white">
                <h4>Login</h4>
            </div>

            <div class="card-body">
                <form method="POST" action="/login">
                    @csrf

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <button class="btn btn-primary w-100">Login</button>
                </form>

                <p class="text-center mt-3">
                    Don’t have an account?
                    <a href="/register">Register</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
