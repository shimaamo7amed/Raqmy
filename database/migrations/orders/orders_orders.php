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
        Schema::disableForeignKeyConstraints();
        Schema::create('orders_orders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->foreignId('user_id')->references('id')->on('users_users')->constrained()->cascadeOnDelete();
            $table->string('payment_id')->nullable();
            $table->decimal('amount');
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
            $table->string('currency')->nullable();
            $table->string('customer_email');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('orders_orders');
        Schema::enableForeignKeyConstraints();
    }
};
