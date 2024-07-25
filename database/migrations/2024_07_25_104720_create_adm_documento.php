<?php

use App\Models\Opciones;
use App\Models\OpcionesMenues99;
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
        Schema::create('adm_documentos', function (Blueprint $table) {
            $table->id('iddocumento');
            $table->string('nombre');
            $table->string('alias');
            $table->text('documento');
            $table->string('tabla');
            $table->timestamps();
        });

        $opcion = Opciones::create([
            'opcion' => 'Documentos', 
            'ruta' => '/admin/documento',
        ]);

        $opcionMenu = OpcionesMenues99::create([
            'idopcion' => $opcion->idopcion,
            'idmenu' => 1, //admin
            'posicion' => 9,
        ]);
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_documentos');

    }
};
