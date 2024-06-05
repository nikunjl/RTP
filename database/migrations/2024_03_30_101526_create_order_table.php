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
            $table->string('order_id')->nullable();
            $table->decimal('stone')->nullable();
            $table->decimal('gross')->nullable();
            $table->decimal('totalnet')->nullable();
            // $table->integer('qty')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('order_status_update_by')->nullable();
            $table->string('photo')->nullable();
            $table->integer('status')->nullable();
            $table->integer('order_status')->nullable();
            $table->string('shift_id')->nullable();
            $table->string('shift_name')->nullable();
            $table->timestamps('order_update_at')->nullable();
            $table->integer('is_sms_sended')->default(0)->comment('0 = not sended, 1 = sended');
            $table->softDeletes();
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
