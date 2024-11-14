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
        Schema::create('grade_ranges', function (Blueprint $table) {
            $table->id();
            $table->decimal('min', 5, 2);
            $table->decimal('max', 5, 2);
            $table->char('letter_grade', 1);
            $table->string('predicate', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_ranges');
    }
};
