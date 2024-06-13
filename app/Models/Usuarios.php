<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios";
	
	protected $fillable = [
        'idusuario','idcliente','nombre','apellido','cedula','movilpersonal','movilempresa','foto','correo','clave','firma','observaciones','idestatus','insertar','editar','listar','eliminar','imprimir','admin','idrol','codigocrm',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idusuario';

    public $timestamps = false; 

		
}
