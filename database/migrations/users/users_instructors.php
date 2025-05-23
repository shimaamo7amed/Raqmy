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
        Schema::create('users_instructors', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            // $table->string('code')->unique();
            $table->string('name_en');
            $table->string('name_ar');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('experince');
            $table->string('linkedIn')->nullable();
            $table->string('cv')->nullable();
            $table->string('password');
            $table->json('desc')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('users_instructors');
        Schema::enableForeignKeyConstraints();
    }
};
