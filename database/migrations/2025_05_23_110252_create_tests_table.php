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
        Schema::create('tests', function (Blueprint $table) { 
            $table->id(); 
            $table->string('title'); 
            $table->string('bidang', 100); 
            $table->string('image')->nullable(); 
            // Path ilustrasi tes, boleh kosong 
            $table->text('description')->nullable(); // Deskripsi tes, boleh kosong 
            $table->timestamps(); // created_at & updated_at 
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tests');
    }
};
