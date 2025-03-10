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
        Schema::create('carts_carts', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->integer('quantity');
            $table->decimal('price');
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->references('id')->on('users_users')->constrained()->cascadeOnDelete();
            $table->foreignId('course_id')->references('id')->on('courses_courses')->constrained()->cascadeOnDelete();
            $table->foreignId('order_id')->references('id')->on('orders_orders')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('carts_carts');
        Schema::enableForeignKeyConstraints();
    }
};
