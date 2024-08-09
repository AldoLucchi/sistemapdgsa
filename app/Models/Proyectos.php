<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;

    protected $table = "sys_proyectos";
	
	protected $fillable = [
        'idproyecto','idcliente','idusuario','nombre','logo','direccion','idestatus','identificadorcontrato','idconstructora','fincamadre','codigoubicacion','codigocrm',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idproyecto';

    public $timestamps = false; 

	//relation

    public function cliente() { 
        return $this->belongsTo(Clientes::class,"idcliente","idcliente"); 
    }

}
