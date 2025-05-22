<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('mentors', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('bidang');
            $table->string('ketersediaan'); // Misalnya: "Pagi", "Sore", "Full"
            $table->float('rating')->nullable(); // Optional, default null
            $table->string('foto')->nullable(); // Nama file atau path ke foto
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
