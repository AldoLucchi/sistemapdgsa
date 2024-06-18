<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosFormascontacto extends Model
{
    use HasFactory;

    protected $table = "vtc_contactos_formascontacto";
	
	protected $fillable = [
        'idformacotacto','formacontacto','fechacreacion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idformacotacto';

    public $timestamps = false; 

		
}
