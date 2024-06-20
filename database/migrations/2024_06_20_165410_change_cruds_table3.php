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
        Schema::table('adm_cruds_generados', function (Blueprint $table) {
            $table->string('alias_opcion_individual')->nullable()->after('alias_opcion');
            $table->text('campos')->nullable()->after('alias_opcion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('adm_cruds_generados', function (Blueprint $table) {
            $table->dropColumn('alias_opcion_individual');
            $table->dropColumn('campos');
        });
    }
};
