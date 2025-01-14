<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('bill_code')->unique(); // ToyyibPay Bill Code
            $table->string('name'); // Donor's name
            $table->string('email'); // Donor's email
            $table->decimal('amount', 10, 2); // Donation amount
            $table->string('status')->default('pending'); // Payment status
            $table->string('transaction_id')->nullable(); // ToyyibPay Transaction ID
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
