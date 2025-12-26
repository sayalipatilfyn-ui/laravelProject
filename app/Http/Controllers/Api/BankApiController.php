<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BankAccount;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BankApiController extends Controller
{
    /**
     * Get or create logged-in user's bank account
     * GET /api/account
     */
    public function account()
    {
        $userId = auth()->id();

        if (!$userId) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $account = BankAccount::firstOrCreate(
            ['user_id' => $userId],
            [
                'account_number' => 'ACC' . rand(100000, 999999),
                'balance' => 0
            ]
        );

        return response()->json($account);
    }

    /**
     * Deposit money
     * POST /api/deposit
     */
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $account = BankAccount::where('user_id', auth()->id())->first();

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        $account->balance += $request->amount;
        $account->save();

        Transaction::create([
            'bank_account_id' => $account->id,
            'type' => 'deposit',
            'amount' => $request->amount
        ]);

        return response()->json([
            'balance' => $account->balance
        ]);
    }

    /**
     * Withdraw money
     * POST /api/withdraw
     */
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1'
        ]);

        $account = BankAccount::where('user_id', auth()->id())->first();

        if (!$account) {
            return response()->json(['error' => 'Account not found'], 404);
        }

        if ($account->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

        $account->balance -= $request->amount;
        $account->save();

        Transaction::create([
            'bank_account_id' => $account->id,
            'type' => 'withdraw',
            'amount' => $request->amount
        ]);

        return response()->json([
            'balance' => $account->balance
        ]);
    }

    /**
     * Transfer money to another account
     * POST /api/transfer
     */
    public function transfer(Request $request)
    {
        $request->validate([
            'account_number' => 'required|string',
            'amount' => 'required|numeric|min:1'
        ]);

        // Sender account
        $from = BankAccount::where('user_id', auth()->id())->first();

        if (!$from) {
            return response()->json(['error' => 'Your bank account does not exist'], 404);
        }

        // Receiver account
        $to = BankAccount::where('account_number', $request->account_number)->first();

        if (!$to) {
            return response()->json(['error' => 'Receiver account not found'], 404);
        }

        // Prevent self-transfer
        if ($from->id === $to->id) {
            return response()->json(['error' => 'Cannot transfer to your own account'], 400);
        }

        // Balance check
        if ($from->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        }

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

    /**
     * Get transaction history
     * GET /api/transactions
     */
   public function transactions()
{
    return Transaction::whereHas('bankAccount', function ($query) {
        $query->where('user_id', auth()->id());
    })
    ->latest()
    ->get();
}
}
