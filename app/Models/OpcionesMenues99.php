<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpcionesMenues99 extends Model
{
    use HasFactory;

    protected $table = "adm_opciones_menues";
	
	protected $fillable = [
        'idopcionnmenu','idopcion','idmenu','posicion','estatus',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idopcionnmenu';

    public $timestamps = false; 

	//relations
    
            public function Opciones() { return $this->hasMany(Opciones::class,"idopcion","idopcion"); }
                
            public function Menues() { return $this->hasMany(Menues::class,"idmenu","idmenu"); }


            public function opcion() { return $this->belongsTo(Opciones::class,"idopcion", "idopcion"); }
                
            public function menu() { return $this->belongsTo(Menues::class,"idmenu","idmenu"); }
                
}
