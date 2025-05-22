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
        Schema::create('mentoring_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mentor_id')->constrained('mentors')->onDelete('cascade');
            $table->string('nama_pemohon');
            $table->string('email');
            $table->text('pesan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentoring_request');
    }
};
