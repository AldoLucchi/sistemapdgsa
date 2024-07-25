<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vtc_usuarios_roles', function (Blueprint $table) {
            $table->unsignedInteger('idvisibilidad')->default(1);
        });

        $visibilidades = [
            ['idvisibilidad' => 1, 'visibilidad' => 'General'],
            ['idvisibilidad' => 2, 'visibilidad' => 'Privada']
        ];
        DB::table('users_visibilidad')->insert($visibilidades);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vtc_usuarios_roles', function (Blueprint $table) {
            $table->dropColumn('idvisibilidad');
        });
    }
};
