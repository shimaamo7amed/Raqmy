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
        Schema::create('courses_courses', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->json('name');
            $table->json('desc');
            $table->decimal('price');
            $table->json('goals');
            $table->enum('status', ['paid', 'free'])->default('paid');
            $table->json('users');
            $table->string('image');
            $table->enum('delivary_method', ['live', 'recorded'])->default('recorded');
            $table->string('time')->nullable();
            $table->decimal('discount')->nullable();
            $table->foreignId('instructors_id')->references('id')->on('users_instructors')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->references('id')->on('categories_categories')->constrained()->cascadeOnDelete();
            $table->string('timeZone')->nullable();
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
        Schema::dropIfExists('courses_courses');
        Schema::enableForeignKeyConstraints();
    }
};
