<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtiquetasDocumentos104 extends Model
{
    use HasFactory;

    protected $table = "adm_etiquetas_documentos";
	
	protected $fillable = [
        'idetiquetadocumento','alias','tabla','campo',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idetiquetadocumento';

    public $timestamps = false; 

	//relations
    
}
