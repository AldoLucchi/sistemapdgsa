<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosProyectos2 extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios_proyectos";
	
	protected $fillable = [
        'idusuarioproyecto','idusuario','idproyecto','idcliente','fechac',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idusuarioproyecto';

    public $timestamps = false; 

	//relations
    
}
