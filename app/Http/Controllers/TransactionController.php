<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TransactionController extends Controller
{
    public function deposit(Request $request) {
        $account = Account::find($request->account_id);
        $account->balance += $request->amount;
        $account->save();

        Transaction::create([
            'account_id'=>$account->id,
            'type'=>'deposit',
            'amount'=>$request->amount
        ]);

        return back();
    }

    public function withdraw(Request $request) {
        $account = Account::find($request->account_id);

        if ($account->balance < $request->amount) {
            return back();
        }

        $account->balance -= $request->amount;
        $account->save();

        Transaction::create([
            'account_id'=>$account->id,
            'type'=>'withdraw',
            'amount'=>$request->amount
        ]);

        return back();
    }
}
