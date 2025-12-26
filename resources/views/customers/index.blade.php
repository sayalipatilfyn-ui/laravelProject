@extends('layout.app')


@section('content')
<div class="container">

<h2>Customers</h2>
@foreach($customers as $c)
<p>{{ $c->name }}   |  {{ $c->email }}
<a href="/customers/{{ $c->id }}"> View</a>
</p>

@endforeach
</div>
@endsection



