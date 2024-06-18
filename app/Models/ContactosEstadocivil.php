<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactosEstadocivil extends Model
{
    use HasFactory;

    protected $table = "vtc_contactos_estadocivil";
	
	protected $fillable = [
        'idestadocivil','estadocivil','fechacreacion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idestadocivil';

    public $timestamps = false; 

		
}
