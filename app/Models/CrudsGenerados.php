<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudsGenerados extends Model
{
    use HasFactory;

    protected $table = "adm_cruds_generados";
	
	protected $fillable = [
        'id','nombre','nombre_componente','alias_opcion','created_at','updated_at',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false; 

		
}
