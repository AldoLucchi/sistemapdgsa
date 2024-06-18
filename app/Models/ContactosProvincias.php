<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosProvincias extends Model
{
    use HasFactory;

    protected $table = "vtc_contactos_provincias";
	
	protected $fillable = [
        'idprovincia','provincia','fechacreacion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idprovincia';

    public $timestamps = false; 

		
}
