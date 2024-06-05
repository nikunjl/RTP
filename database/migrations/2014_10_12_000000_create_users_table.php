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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile_no')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('photo')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('pan_number')->nullable();
            $table->string('gst_number')->nullable();
            $table->integer('role')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('type')->default(0);
            $table->integer('grant_access')->default(0);
            $table->text('notification_token')->nullable();
            $table->enum('status',array(0,1))->default(1)->comment('0 = INACTIVE || 1 = ACTIVE');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};