<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;


class BankApiController extends Controller
{  
public function transfer(Request $request)
{
    $request->validate([
        'account_number' => 'required',
        'amount' => 'required|numeric|min:1',
    ]);

    // Sender account
    $from = BankAccount::where('user_id', auth()->id())->first();

    if (!$from) {
        return response()->json([
            'error' => 'Your bank account does not exist'
        ], 404);
    }

    // Receiver account
    $to = BankAccount::where('account_number', $request->account_number)->first();

    if (!$to) {
        return response()->json([
            'error' => 'Receiver account not found'
        ], 404);
    }

    // Prevent self-transfer
    if ($from->id === $to->id) {
        return response()->json([
            'error' => 'Cannot transfer money to your own account'
        ], 400);
    }

    // Balance check
    if ($from->balance < $request->amount) {
        return response()->json([
            'error' => 'Insufficient balance'
        ], 400);
    }

    // DB transaction (VERY IMPORTANT)
    DB::transaction(function () use ($from, $to, $request) {

        $from->decrement('balance', $request->amount);
        $to->increment('balance', $request->amount);

        Transaction::create([
            'bank_account_id' => $from->id,
            'type' => 'transfer',
            'amount' => $request->amount
        ]);
    });

    return response()->json([
        'success' => 'Money transferred successfully'
    ]);
}

}
