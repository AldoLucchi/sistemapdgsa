<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentos61 extends Model
{
    use HasFactory;

    protected $table = "adm_documentos";
	
	protected $fillable = [
        'iddocumento','nombre','alias','documento','tabla',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'iddocumento';

    public $timestamps = false; 

	//relations
    
}
