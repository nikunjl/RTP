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
        Schema::create('addtocarts', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('karat_id')->nullable();
            $table->string('size_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('order_status')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addtocarts');
    }
};
