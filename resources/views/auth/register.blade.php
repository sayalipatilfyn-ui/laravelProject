@extends('layout.app') 
@section('content')
@csrf
<form method="POST" action="/register">@csrf
<input name="name" placeholder="Name">
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<input type="password" name="password_confirmation" placeholder="Confirm">
<button>Register</button>
</form>
@endsection
