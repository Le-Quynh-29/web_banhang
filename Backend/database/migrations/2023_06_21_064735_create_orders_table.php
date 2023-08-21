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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('phone_number', 20);
            $table->string('address');
            $table->integer('total');
            $table->tinyInteger('status')->default(1);
            $table->dateTime('transaction_time');
            $table->dateTime('delivery_time')->nullable();
            $table->dateTime('received_time')->nullable();
            $table->dateTime('cancellation_time')->nullable();
            $table->string('note_cancle')->nullable();
            $table->string('note')->nullable();
            $table->tinyInteger('payment_method');
            $table->string('account_holder')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank')->nullable();
            $table->string('transfer_note')->nullable();
            $table->unsignedBigInteger('voucher_id')->nullable();
            $table->tinyInteger('voucher_type')->nullable();
            $table->integer('discount_voucher')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
