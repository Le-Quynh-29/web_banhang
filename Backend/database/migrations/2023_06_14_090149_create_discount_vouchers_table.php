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
        Schema::create('discount_vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 50);
            $table->string('name');
            $table->tinyInteger('type');
            $table->longText('description')->nullable();
            $table->integer('discount');
            $table->integer('quantity');
            $table->integer('quantity_used')->default(0);
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_vouchers');
    }
};
