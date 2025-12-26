<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'bank_account_id',
        'type',
        'amount'
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }
}
