<h2>Customers</h2>
<a href="/customers/create">Add Customer</a>
@foreach($customers as $c)
<p>{{ $c->name }} | {{ $c->email }}
<a href="/customers/{{ $c->id }}">View</a>
</p>
@endforeach
