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
        Schema::table('vtc_usuarios_roles', function (Blueprint $table) {
            $table->string('exclude',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vtc_usuarios_roles', function (Blueprint $table) {
            $table->dropColumn('exclude');
        });
    }
};
