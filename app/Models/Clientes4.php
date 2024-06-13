<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes4 extends Model
{
    use HasFactory;

    protected $table = "vtc_clientes";
	
	protected $fillable = [
        'idcliente','nombre',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idcliente';

    public $timestamps = false; 

	//relations
    
}
