@extends('layout.app')
@section('content')
@csrf
<form method="POST" action="/login">@csrf
<input name="email" placeholder="Email">
<input type="password" name="password" placeholder="Password">
<button>Login</button>
</form>
@endsection
