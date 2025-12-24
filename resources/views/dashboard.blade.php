@extends('layout.app')

@section('content')
<div class="container">
    <h2>Dashboard</h2>

    <ul>
        <li><a href="/customers/create">New Customer</a></li>
        <li><a href="/customers">View Customers</a></li>
    </ul>
</div>
@endsection
