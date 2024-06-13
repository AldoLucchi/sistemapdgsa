<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrudsGeneradosMenues100 extends Model
{
    use HasFactory;

    protected $table = "adm_cruds_generados_menues";
	
	protected $fillable = [
        'idcrudgenmenu','idcrudgen','idmenu','posicion','estatus',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idcrudgenmenu';

    public $timestamps = false; 

	//relations
    
            public function CrudsGenerados() { return $this->hasMany(CrudsGenerados::class,"idcrudgen","idcrudgen"); }
                
            public function Menues() { return $this->hasMany(Menues::class,"idmenu","idmenu"); }

            public function crud() { return $this->belongsTo(CrudsGenerados::class,"idcrudgen", "id"); }
                
            public function menu() { return $this->belongsTo(Menues::class,"idmenu","idmenu"); }
                
}
