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
            $table->string('reg_number')->unique();
            $table->string('full_name');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('gender');
            $table->text('address');
            $table->string('school');
            $table->string('major');
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('position_id');
            $table->text('cv');
            $table->text('motivation_letter');
            $table->text('cover_letter')->nullable();
            $table->text('portfolio');
            $table->string('photo');
            $table->string('status');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->text('messages')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('position_id')->references('id')->on('positions');
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
