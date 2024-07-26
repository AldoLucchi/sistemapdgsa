<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora71 extends Model
{
    use HasFactory;

    protected $table = "vtc_bitacora";
	
	protected $fillable = [
        'idbitacora','crud','tabla','id','campoid','idaccion','descripcion','idproyecto','idcliente','ip','fecha',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idbitacora';

    public $timestamps = false; 

	//relations
    
                public function CrudsGenerados() { return $this->hasMany(CrudsGenerados::class,"id","idcrud"); }
                    
                public function BitacorasAcciones() { return $this->hasMany(BitacorasAcciones::class,"idaccion","idaccion"); }
                    
                public function Proyectos() { return $this->hasMany(Proyectos::class,"idproyecto","idproyecto"); }
                    
                public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                    
}
