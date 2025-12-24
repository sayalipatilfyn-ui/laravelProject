<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CustomerController;   
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return redirect('/login');
});
Route::get('/register', [RegisterController::class, 'show']);
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
/*
Route::get('/logout',function(){
    return redirect('/login');
})*/

Route::middleware('auth')->group(function () {
    Route::resource('customers', CustomerController::class);
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

});