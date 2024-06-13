<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users13 extends Model
{
    use HasFactory;

    protected $table = "users";
	
	protected $fillable = [
        'id','name','email','password','avatar','idcliente','nombre','apellido','cedula','movilpersonal','movilempresa','foto','firma','observaciones','idestatus','insertar','editar','listar','eliminar','imprimir','admin','idrol','codigocrm',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false; 

	//relations
    
                public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                    
                public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"idestatus","idestatus"); }
                    
                public function UsuariosRoles() { return $this->hasMany(UsuariosRoles::class,"idrol","idrol"); }
                    
}
