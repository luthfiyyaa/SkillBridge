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
        Schema::create('jadwals', function (Blueprint $table) {
        $table->id();
        $table->date('tanggal');
        $table->string('topik');
        $table->string('status'); // Mendatang, Selesai, Dibatalkan
        $table->unsignedBigInteger('mentor_id')->nullable();
        $table->string('kontak');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
