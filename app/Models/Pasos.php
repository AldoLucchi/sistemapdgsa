<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasos extends Model
{
    use HasFactory;

    protected $table = "vtc_pasos";
	
	protected $fillable = [
        'idpaso','paso','fechacreacion',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idpaso';

    public $timestamps = false; 

		
}
