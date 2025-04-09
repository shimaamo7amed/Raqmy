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
            $table->string('name')->nullable();
            $table->string('userName')->unique()->nullable();
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
            $table->foreignId('role_id')->nullable()->references('id')->on('roles')->constrained()->cascadeOnDelete();
            // instructor-specific fields
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->string('experince')->nullable();
            $table->string('linkedIn')->nullable();
            $table->string('cv')->nullable();
            $table->json('desc')->nullable();
            $table->string('facebook')->nullable();
            $table->string('website')->nullable();
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
