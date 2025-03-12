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
        Schema::create('countries_governments', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('label_en');
            $table->string('label_ar');
            $table->string('value_en');
            $table->string('value_ar');
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries_countries')->onDelete('cascade');
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
        Schema::dropIfExists('countries_governments');
        Schema::enableForeignKeyConstraints();
    }
};
