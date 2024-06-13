<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users8 extends Model
{
    use HasFactory;

    protected $table = "users";
	
	protected $fillable = [
        'id','name','email','password','idcliente','nombre','apellido','cedula','movilpersonal','movilempresa','observaciones','idestatus','idrol',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false; 

	//relations
    
                public function UsuariosEstatus() { return $this->hasMany(UsuariosEstatus::class,"idestatus","idestatus"); }
                    
                public function UsuariosRoles() { return $this->hasMany(UsuariosRoles::class,"idrol","idrol"); }
                    
}
