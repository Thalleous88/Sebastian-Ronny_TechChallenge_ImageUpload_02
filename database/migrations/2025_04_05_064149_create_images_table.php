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
        // Membuat tabel baru bernama 'images'
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // membuat variabel id
            $table->string('filename'); // membuat variabel filename yang menyimpan nama/path file gambar
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel images jika tabel/migration direfresh/rollback
        Schema::dropIfExists('images');
    }
};
