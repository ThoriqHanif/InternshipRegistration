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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained('interns')->onDelete('cascade');
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('aspect_id')->constrained('aspects')->onDelete('cascade');
            $table->decimal('total_score', 5, 2)->nullable();
            $table->integer('total_inputted')->nullable();
            $table->decimal('average_score', 5, 2)->nullable();
            $table->decimal('final_score', 5, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
