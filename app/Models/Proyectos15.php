<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos15 extends Model
{
    use HasFactory;

    protected $table = "sys_proyectos";
	
	protected $fillable = [
        'idproyecto','nombre','idcliente','logo','direccion','idestatus','identificadorcontrato','codigoubicacion',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idproyecto';

    public $timestamps = false; 

	//relations
    
}
