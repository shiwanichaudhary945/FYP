<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            // $table->string('transaction_id')->unique();
            // $table->integer('amount');
            // $table->string('status');
            $table->string('user_id')->nullable();  // You might want to use 'unsignedBigInteger' for user_id if it's related to a users table
            $table->string('token');  // Payment token from Khalti
            $table->integer('amount');  // Amount paid in paisa (integer type for accurate calculations)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
