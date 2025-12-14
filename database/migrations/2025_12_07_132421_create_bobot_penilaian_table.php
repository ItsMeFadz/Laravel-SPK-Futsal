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
        Schema::create('bobot_penilaian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->foreignId('pemain_id')->constrained('pemain')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->integer('bobot')->nullable(); // input admin, misal 4
            $table->decimal('bobot_wj', 8, 4)->nullable(); // hasil normalisasi otomatis, misal 0.40
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_penilaian');
    }
};
