@extends('layout')

@section('title', 'Transaction History')

@section('content')

<h3 class="mb-4">Transaction History</h3>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody id="transactionTable">
                <tr>
                    <td colspan="4" class="text-center">Loading...</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<a href="/dashboard" class="btn btn-secondary mt-3">Back to Dashboard</a>

<script>
fetch('/api/transactions')
    .then(res => res.json())
    .then(data => {
        let html = '';

        if (data.length === 0) {
            html = `<tr><td colspan="4" class="text-center">No transactions found</td></tr>`;
        } else {
            data.forEach((t, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${t.type.toUpperCase()}</td>
                        <td>₹ ${t.amount}</td>
                        <td>${new Date(t.created_at).toLocaleString()}</td>
                    </tr>
                `;
            });
        }

        document.getElementById('transactionTable').innerHTML = html;
    });
</script>

@endsection
