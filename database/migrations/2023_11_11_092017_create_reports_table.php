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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('intern_id')->constrained('interns')->onDelete('cascade');
            $table->date('date');
            $table->time('attendance_time');
            $table->enum('presence', ['Masuk', 'Izin', 'Alpa', 'Libur']);
            $table->boolean('is_late')->default(false);
            $table->boolean('is_consequence_done')->default(false);
            $table->text('consequence_description')->nullable();
            $table->string('agency')->nullable();
            $table->string('project_name')->nullable();
            $table->string('job')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['Pending', 'Verified', 'Rejected'])->default('Pending');
            $table->text('admin_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
