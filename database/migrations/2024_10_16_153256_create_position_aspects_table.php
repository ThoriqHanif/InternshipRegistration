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
        Schema::create('position_aspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->constrained('positions')->onDelete('cascade');
            $table->foreignId('aspect_id')->constrained('aspects')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('position_aspects');
    }
};
