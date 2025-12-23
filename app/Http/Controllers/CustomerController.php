<?php

namespace App\Http\Controllers;

use id;
use App\Models\Account;
use App\Models\Customer;
use Illuminate\Http\Request;
//use App\Http\CustomerController;

class CustomerController extends Controller
{
    public function index() {
        $customers = Customer::where('user_id', auth()->id())->get();
        return view('customers.index', compact('customers'));
    }

    public function create() {
        return view('customers.create');
    }

    public function store(Request $request) {
        $customer = Customer::create([
            'user_id'=>auth()->id(),
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
        ]);

        Account::create([
            'customer_id'=>$customer->id,
            'account_number'=>rand(10000000,99999999),
            'balance'=>0
        ]);

        return redirect('/customers');
    }

   public function show($id)
{
    $customer = Customer::where('id', $id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    return view('customers.show', compact('customer'));
}

    public function edit(Customer $customer) {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer) {
        $customer->update($request->all());
        return redirect('/customers');
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return redirect('/customers');
    }
}
