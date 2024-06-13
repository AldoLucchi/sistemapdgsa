<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios1 extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios";
	
	protected $fillable = [
        'idcliente','nombre','apellido','cedula','movilpersonal','movilempresa','foto','correo','clave','firma','observaciones','idestatus','admin','idrol',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idusuario';

    public $timestamps = false; 

	//relations
    
            public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                
            public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"idestatus","idestatus"); }
                
            public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"admin","admin"); }
                
            public function UsuariosRoles() { return $this->hasMany(UsuariosRoles::class,"idrol","idrol"); }
                
}
