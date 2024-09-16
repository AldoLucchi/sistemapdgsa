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
        Schema::table('adm_menues', function (Blueprint $table) {
            $table->string('icono')->default('abstract-30')->nullable()->after('ruta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adm_menues', function (Blueprint $table) {
            $table->dropColumn('icono');
        });
    }
};
