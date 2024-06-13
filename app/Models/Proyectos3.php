<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos3 extends Model
{
    use HasFactory;

    protected $table = "sys_proyectos";
	
	protected $fillable = [
        'idcliente','nombre','logo','direccion','idestatus','identificadorcontrato','fincamadre','codigoubicacion',
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
                
            public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"idestatus","idestatus"); }
                
}
