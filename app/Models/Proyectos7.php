<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos7 extends Model
{
    use HasFactory;

    protected $table = "sys_proyectos";
	
	protected $fillable = [
        'idproyecto','idcliente','nombre',
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
                    
}
