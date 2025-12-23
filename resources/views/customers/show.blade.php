@extends('layout.app')

@section('content')
<div class="container">
<h2>Customer Details</h2>

<p><b>Name:</b> {{ $customer->name }}</p>
<p><b>Email:</b> {{ $customer->email }}</p>
<p><b>Phone:</b> {{ $customer->phone }}</p>

<a href="/customers/{{ $customer->id }}/edit">Edit</a> |
<a href="/customers">Back</a>
</div>
@endsection
