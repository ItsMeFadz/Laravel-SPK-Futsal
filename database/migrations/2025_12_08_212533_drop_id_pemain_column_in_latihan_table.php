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
        Schema::table('latihan', function (Blueprint $table) {
            $table->dropForeign(['id_pemain']);
            $table->dropColumn('id_pemain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('latihan', function (Blueprint $table) {
            $table->foreignId('id_pemain')->nullable()->constrained('pemain')->onDelete('cascade');
        });
    }
};
