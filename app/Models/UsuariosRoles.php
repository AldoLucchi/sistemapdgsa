<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosRoles extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios_roles";
	
	protected $fillable = [
        'idrol','rol','descripcion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idrol';

    public $timestamps = false; 

		
}
