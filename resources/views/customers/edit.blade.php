@extends('layout.app')

@section('content')
<div class="container">
<h2>Edit Customer</h2>

<form method="POST" action="/customers/{{ $customer->id }}">
    @csrf
    @method('PUT')

    <input name="name" value="{{ $customer->name }}" required>
    <input name="email" value="{{ $customer->email }}" required>
    <input name="phone" value="{{ $customer->phone }}" required>

    <button>Update Customer</button>
</form>
</div>
@endsection
