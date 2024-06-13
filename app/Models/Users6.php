<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users6 extends Model
{
    use HasFactory;

    protected $table = "users";
	
	protected $fillable = [
        'id','name','email','password','idcliente','nombre','apellido','cedula','movilpersonal','movilempresa',
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
                    
}
