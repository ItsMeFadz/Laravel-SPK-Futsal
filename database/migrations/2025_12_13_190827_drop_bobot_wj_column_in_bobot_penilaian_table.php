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
        Schema::table('bobot_penilaian', function (Blueprint $table) {
            $table->dropColumn('bobot_wj');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bobot_penilaian', function (Blueprint $table) {
            $table->decimal('bobot_wj', 8, 4)->nullable();
        });
    }
};
