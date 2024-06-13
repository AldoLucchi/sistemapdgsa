<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosProyectos6 extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios_proyectos";
	
	protected $fillable = [
        'idusuarioproyecto','idusuario','idproyecto','idcliente',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idusuarioproyecto';

    public $timestamps = false; 

	//relations
    
                public function Users() { return $this->hasMany(Users::class,"id","idusuario"); }
                    
                public function Proyectos() { return $this->hasMany(Proyectos::class,"idproyecto","idproyecto"); }
                    
                public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                    
}
