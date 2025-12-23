@extends('layout.app')
@section('content')
@foreach($accounts as $a)
<p>{{ $a->account_number }} - {{ $a->balance }}</p>
@endforeach
@endsection
