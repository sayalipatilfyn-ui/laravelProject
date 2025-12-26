<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BankApiController;
Route::middleware('auth')->group(function () {
    Route::get('/account', [BankApiController::class, 'account']);
    Route::post('/deposit', [BankApiController::class, 'deposit']);
    Route::post('/withdraw', [BankApiController::class, 'withdraw']);
    Route::post('/transfer', [BankApiController::class, 'transfer']);
    Route::get('/transactions', [BankApiController::class, 'transactions']);
});