<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bobot_posisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posisi_id')->constrained('posisi')->onDelete('cascade');
            $table->foreignId('kriteria_id')->constrained('kriteria')->onDelete('cascade');
            $table->integer('bobot'); // input admin, misal 4
            $table->double('bobot_wj'); // hasil normalisasi otomatis, misal 0.40
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bobot_posisi');
    }
};
