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
        Schema::table('cruds', function (Blueprint $table) {
            $table->string('alias_opcion')->nullable()->after('name');
            $table->string('nombre_componente')->nullable()->after('name');
            $table->renameColumn('name', 'nombre');

        });

        Schema::rename('cruds', 'adm_cruds_generados');

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('adm_cruds_generados', 'cruds');

        Schema::table('cruds', function (Blueprint $table) {
            $table->dropColumn('alias_opcion');
            $table->dropColumn('nombre_componente');
            $table->renameColumn('nombre', 'name');
        });
    }
};
