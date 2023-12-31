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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('plug');
            $table->json('details')->nullable();
            $table->longText('description')->nullable();
            $table->integer('like');
            $table->integer('buy');
            $table->integer('view');
            $table->integer('price_form');
            $table->integer('price_to');
            $table->unsignedBigInteger('user_id');
            $table->longText('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
