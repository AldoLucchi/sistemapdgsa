<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacorasAcciones extends Model
{
    use HasFactory;

    protected $table = "vtc_bitacoras_acciones";
	
	protected $fillable = [
        'idaccion','accion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idaccion';

    public $timestamps = false; 

		
}
