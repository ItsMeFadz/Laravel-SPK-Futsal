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
        Schema::create('detail_latihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('latihan_id')->constrained('latihan')->onDelete('cascade');
            $table->foreignId('pemain_id')->constrained('pemain')->onDelete('cascade');
            $table->date('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_latihan');
    }
};
