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
        Schema::table('forms_instructors', function (Blueprint $table) {
            $table->string('status')->nullable()->default('Pending');
        });
    }

    public function down(): void
    {
        Schema::table('forms_instructors', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
