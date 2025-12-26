<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bank_account_id');
            $table->enum('type', ['deposit', 'withdraw', 'transfer']);
            $table->decimal('amount', 12, 2);
            $table->timestamps();

            $table->foreign('bank_account_id')
                  ->references('id')
                  ->on('bank_accounts')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
