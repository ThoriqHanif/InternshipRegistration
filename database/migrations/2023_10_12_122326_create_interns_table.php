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
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->nullable()->constrained('positions')->onDelete('set null');
            $table->foreignId('periode_id')->nullable()->constrained('periodes')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('reg_number')->unique();
            $table->string('full_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->enum('gender', ['male', 'female']);
            $table->text('address');
            $table->string('school');
            $table->string('major');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('url')->nullable();
            $table->text('cv');
            $table->text('motivation_letter');
            $table->text('cover_letter')->nullable();
            $table->text('portfolio');
            $table->string('photo');
            $table->enum('status', ['pending', 'interview', 'accepted', 'rejected'])->default('pending');
            $table->text('messages')->nullable();
            $table->date('registration_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};
