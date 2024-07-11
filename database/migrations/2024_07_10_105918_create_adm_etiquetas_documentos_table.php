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
        Schema::create('adm_etiquetas_documentos', function (Blueprint $table) {
            $table->id('idetiquetadocumento');
            $table->string('alias');
            $table->string('tabla');
            $table->string('campo');
            $table->timestamps();
        });

        $opcion = Opciones::create([
            'opcion' => 'Etiquetas Documentos', 
            'ruta' => '/admin/etiquetaDocumento',
        ]);

        $opcionMenu = OpcionesMenues99::create([
            'idopcion' => $opcion->idopcion,
            'idmenu' => 1, //admin
            'posicion' => 10,
        ]);
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_etiquetas_documentos');
    }
};
