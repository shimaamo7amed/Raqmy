<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users_users', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('user_name')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('bio')->nullable();
            $table->string('otp')->nullable();
            $table->string('government')->nullable();
            $table->string('image')->nullable();
            $table->string('social_id')->nullable();
            $table->string('social_type')->nullable();
            $table->text('jwt_token')->nullable();
            // $table->foreignId('country_id')->nullable()->references('id')->on('countries_countries')->constrained()->cascadeOnDelete();
            // $table->foreignId('government_id')->nullable()->references('id')->on('countries_governments')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('users_users');
        Schema::enableForeignKeyConstraints();
    }

};
