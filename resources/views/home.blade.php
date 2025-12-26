@extends('layout')

@section('title', 'Home | Bank Management System')

@section('content')

<div class="hero text-center mb-5">
    <h1 class="fw-bold">Welcome to Bank Management System</h1>
    <p class="lead mt-3">
        Secure • Fast • Reliable Banking Solution
    </p>
    
    
</div>

<div class="row text-center">
    <div class="col-md-4">
        <div class="card feature-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">🔐 Secure Banking</h5>
                <p class="card-text">
                    Token-based authentication and protected APIs ensure your data is always safe.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card feature-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">💳 Account Management</h5>
                <p class="card-text">
                    Create accounts, check balance, deposit and withdraw money easily.
                </p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card feature-card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📊 Transaction History</h5>
                <p class="card-text">
                    Track all your transactions with a clear and simple interface.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
