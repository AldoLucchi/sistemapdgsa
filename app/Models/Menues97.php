<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menues97 extends Model
{
    use HasFactory;

    protected $table = "adm_menues";
	
	protected $fillable = [
        'idmenu','menu','estatus','ruta',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idmenu';

    public $timestamps = false; 

	//relations
    
}
