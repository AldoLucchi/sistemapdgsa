<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuariosEstatus extends Model
{
    use HasFactory;

    protected $table = "vtc_usuarios_estatus";
	
	protected $fillable = [
        'idestatus','estatus',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idestatus';

    public $timestamps = false; 

		
}
