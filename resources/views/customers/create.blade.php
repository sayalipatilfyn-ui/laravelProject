@extends('layout.app')

@section('content')
<div class="container">
<h2>New Customer</h2>

<form method="POST" action="/customers">
    @csrf
    <input name="name" placeholder="Customer Name" required>
    <input name="email" placeholder="Customer Email" required>
    <input name="phone" placeholder="Phone Number" required>
    <button>Add Customer</button>
</form>
</div>
@endsection
