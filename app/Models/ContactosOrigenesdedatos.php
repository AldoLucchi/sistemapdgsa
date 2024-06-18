<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosOrigenesdedatos extends Model
{
    use HasFactory;

    protected $table = "vtc_contactos_origenesdedatos";
	
	protected $fillable = [
        'idorigendedato','origendedato','fechacreacion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idorigendedato';

    public $timestamps = false; 

		
}
