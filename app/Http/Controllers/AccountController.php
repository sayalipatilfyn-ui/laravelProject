<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AccountController extends Controller
{
   public function index()
    {
        return view('accounts.index', [
            'accounts' => Account::with('customer')->get()
        ]);
    }
}
