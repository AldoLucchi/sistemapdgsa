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
        Schema::table('vtc_accesosdirectos', function (Blueprint $table) {
            $table->unsignedInteger('idrol')->nullable();
            $table->unsignedBigInteger('idusuario')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vtc_accesosdirectos', function (Blueprint $table) {
            $table->dropColumn('idrol');
            $table->dropColumn('idusuario');
        });
    }
};
