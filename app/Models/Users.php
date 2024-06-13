<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = "users";
	
	protected $fillable = [
        'id','name','email','profile_photo_path','email_verified_at','password','avatar','idcliente','nombre','apellido','cedula','movilpersonal','movilempresa','foto','firma','observaciones','idestatus','insertar','editar','listar','eliminar','imprimir','admin','idrol','codigocrm','remember_token','created_at','updated_at','last_login_at','last_login_ip',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false; 

		
}
