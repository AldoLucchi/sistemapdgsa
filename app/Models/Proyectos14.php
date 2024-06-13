<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos14 extends Model
{
    use HasFactory;

    protected $table = "sys_proyectos";
	
	protected $fillable = [
        'idproyecto','nombre','idcliente','idusuario','logo','direccion','idestatus','identificadorcontrato','idconstructora','fincamadre','codigoubicacion','codigocrm',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idproyecto';

    public $timestamps = false; 

	//relations
    
                public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                    
                public function Usuarios() { return $this->hasMany(Usuarios::class,"idusuario","idusuario"); }
                    
                public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"idestatus","idestatus"); }
                    
}
