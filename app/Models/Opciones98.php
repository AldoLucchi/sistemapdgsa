<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opciones98 extends Model
{
    use HasFactory;

    protected $table = "adm_opciones";
	
	protected $fillable = [
        'idopcion','opcion','ruta',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idopcion';

    public $timestamps = false; 

	//relations
    
}
