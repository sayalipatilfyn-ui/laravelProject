<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'balance'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
