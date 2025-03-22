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
        Schema::create('programs_programs', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->id();
            $table->string('code')->unique();
            $table->json('title');
            $table->json('desc');
            $table->decimal('total_price',10,2);
            $table->decimal('discount', 5, 2)->default(0);
            $table->decimal('price_after', 10, 2)->nullable();
            $table->string("courses_hour");
            $table->string("courses_number");
            $table->string("courses_image");
            $table->string("courses_video");
            $table->json('goals');
            $table->json('career_path');
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
        Schema::dropIfExists('programs_programs');
        Schema::enableForeignKeyConstraints();
    }
};
