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
        // adm_menues------
        Schema::create('adm_menues', function (Blueprint $table) {
            $table->id('idmenu');
            $table->string('menu');
            $table->boolean('estatus')->default(true);
            $table->string('ruta');
            $table->timestamps();
        });

        $menu = array('idmenu' => 1, 'menu' => 'ADMIN', 'ruta' => 'admin');
        DB::table('adm_menues')->insert($menu);

        // adm_opciones -----
        Schema::create('adm_opciones', function (Blueprint $table) {
            $table->id('idopcion');
            $table->string('opcion');
            $table->string('ruta');
            $table->timestamps();
        });

        $opcion = [
            array('idopcion' => 1, 'opcion' => 'CRUD', 'ruta' => '/admin/crud'),
            array('idopcion' => 2, 'opcion' => 'Menu', 'ruta' => '/admin/menu'),
            array('idopcion' => 3, 'opcion' => 'Menu x CRUD', 'ruta' => '/admin/menuCrud'),
            array('idopcion' => 4, 'opcion' => 'Opcion', 'ruta' => '/admin/opcion'),
            array('idopcion' => 5, 'opcion' => 'Menu x Opcion', 'ruta' => '/admin/menuOpcion'),
            array('idopcion' => 6, 'opcion' => 'Menu Asignado', 'ruta' => '/admin/menuAsignado')
        ];
        DB::table('adm_opciones')->insert($opcion);

        // adm_cruds_generados_menues ----
        Schema::create('adm_cruds_generados_menues', function (Blueprint $table) {
            $table->id('idcrudgenmenu');
            $table->unsignedBigInteger('idcrudgen');
            $table->unsignedBigInteger('idmenu');
            $table->unsignedInteger('posicion')->nullable();
            $table->boolean('estatus')->default(true);
            $table->timestamps();
        });


        // adm_opciones_menues -----
        Schema::create('adm_opciones_menues', function (Blueprint $table) {
            $table->id('idopcionnmenu');
            $table->unsignedBigInteger('idopcion');
            $table->unsignedBigInteger('idmenu');
            $table->unsignedInteger('posicion')->nullable();
            $table->boolean('estatus')->default(true);
            $table->timestamps();
        });

        $opcion = [
            array('idopcion' => 1, 'idmenu' => 1),
            array('idopcion' => 2, 'idmenu' => 1),
            array('idopcion' => 3, 'idmenu' => 1),
            array('idopcion' => 4, 'idmenu' => 1),
            array('idopcion' => 5, 'idmenu' => 1),
            array('idopcion' => 6, 'idmenu' => 1)
        ];
        DB::table('adm_opciones_menues')->insert($opcion);


        // adm_menues_asignados ----
        Schema::create('adm_menues_asignados', function (Blueprint $table) {
            $table->id('idnmenuasignado');
            $table->unsignedBigInteger('idmenu');
            $table->unsignedInteger('idcliente');
            $table->unsignedInteger('idrol');
            $table->boolean('estatus')->default(true);
            $table->unsignedInteger('idproyecto')->nullable();
            $table->unsignedInteger('posicion')->nullable();
            $table->timestamps();
        });

        $menu = array('idmenu' => 1, 'idcliente' => 1, 'idrol' => 1);
        DB::table('adm_menues_asignados')->insert($menu);


        Schema::table('users', function (Blueprint $table) {
            $table->string('codigocrm')->nullable()->after('avatar');
            $table->unsignedInteger('idrol')->nullable()->after('avatar');
            $table->unsignedInteger('admin')->nullable()->after('avatar');
            $table->boolean('imprimir')->default(false)->after('avatar');
            $table->boolean('eliminar')->default(false)->after('avatar');
            $table->boolean('listar')->default(false)->after('avatar');
            $table->boolean('editar')->default(false)->after('avatar');
            $table->boolean('insertar')->default(false)->after('avatar');
            $table->unsignedInteger('idestatus')->nullable()->after('avatar');
            $table->text('observaciones')->nullable()->after('avatar');
            $table->string('firma')->nullable()->after('avatar');
            $table->string('foto')->nullable()->after('avatar');
            $table->string('movilempresa')->nullable()->after('avatar');
            $table->string('movilpersonal')->nullable()->after('avatar');
            $table->string('cedula')->nullable()->after('avatar');
            $table->string('apellido')->nullable()->after('avatar');
            $table->string('nombre')->nullable()->after('avatar');
            $table->unsignedInteger('idcliente')->nullable()->after('avatar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adm_menues');
        Schema::dropIfExists('adm_opciones');
        Schema::dropIfExists('adm_cruds_generados_menues');
        Schema::dropIfExists('adm_opciones_menues');
        Schema::dropIfExists('adm_menues_asignados');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'codigocrm',
                'idrol',
                'admin',
                'imprimir',
                'eliminar',
                'editar',
                'listar',
                'insertar',
                'idestatus',
                'observaciones',
                'firma',
                'foto',
                'movilempresa',
                'movilpersonal',
                'cedula',
                'apellido',
                'nombre',
                'idcliente'
            ]);
        });
    }
};
