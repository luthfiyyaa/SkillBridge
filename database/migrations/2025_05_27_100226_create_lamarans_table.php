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
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email');
            $table->string('telepon');
            $table->integer('pengalaman');
            $table->text('alasan');
            $table->string('file_portofolio')->nullable();
            $table->string('status')->default('Proses');
            $table->unsignedBigInteger('lowongan_id');
            $table->timestamps();

            $table->foreign('lowongan_id')->references('id')->on('lowongans')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamarans');
    }
};
