@extends('layout')

@section('title', 'Dashboard')

@section('content')

<h3 class="mb-4">Welcome, {{ auth()->user()->name }}</h3>

<!-- BALANCE CARD -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow text-center">
            <div class="card-body">
                <h5>Current Balance</h5>
                <h2 class="text-success">
                    ₹ <span id="balance">0</span>
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- DEPOSIT & WITHDRAW -->
<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                Deposit Money
            </div>
            <div class="card-body">
                <input type="number" id="depositAmount" class="form-control" placeholder="Enter amount">
                <button class="btn btn-success w-100 mt-2" onclick="depositMoney()">Deposit</button>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-danger text-white">
                Withdraw Money
            </div>
            <div class="card-body">
                <input type="number" id="withdrawAmount" class="form-control" placeholder="Enter amount">
                <button class="btn btn-danger w-100 mt-2" onclick="withdrawMoney()">Withdraw</button>
            </div>
        </div>
    </div>
</div>

<a href="/transactions" class="btn btn-link mt-4">
    View Transaction History
</a>

<!-- JAVASCRIPT (SESSION-BASED AJAX) -->
<script>
const csrfToken = '{{ csrf_token() }}';

// Load balance on page load
function loadBalance() {
    fetch('/api/account')
        .then(response => response.json())
        .then(data => {
            if (data.balance !== undefined) {
                document.getElementById('balance').innerText = data.balance;
            }
        });
}

// Deposit money
function depositMoney() {
    const amount = document.getElementById('depositAmount').value;
        console.log('amount: '+amount);
        
    if (!amount || amount <= 0) {
        alert('Please enter a valid amount');
        return;
    }

    fetch('deposit', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ amount: amount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.balance !== undefined) {
            document.getElementById('balance').innerText = data.balance;
            document.getElementById('depositAmount').value = '';
        }
    });
}

// Withdraw money
function withdrawMoney() {
    const amount = document.getElementById('withdrawAmount').value;

    if (!amount || amount <= 0) {
        alert('Please enter a valid amount');
        return;
    }

    fetch('/api/withdraw', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ amount: amount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else if (data.balance !== undefined) {
            document.getElementById('balance').innerText = data.balance;
            document.getElementById('withdrawAmount').value = '';
        }
    });
}

// Load balance automatically
loadBalance();
</script>

@endsection
