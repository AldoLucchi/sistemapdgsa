<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menues extends Model
{
    use HasFactory;

    protected $table = "adm_menues";
	
	protected $fillable = [
        'idmenu','menu','estatus','ruta','icono','created_at','updated_at',
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idmenu';

    public $timestamps = false; 

    public function opciones() { return $this->belongsToMany(Opciones::class,"adm_opciones_menues", "idmenu","idopcion")->wherePivot('estatus', 1)->withPivot('posicion')->orderByPivot('posicion', 'asc'); }
    public function cruds() { return $this->belongsToMany(CrudsGenerados::class,"adm_cruds_generados_menues", "idmenu","idcrudgen")->wherePivot('estatus', 1)->withPivot('posicion')->orderByPivot('posicion', 'asc'); }

    public function opciones_menues() { return $this->hasMany(OpcionesMenues99::class,"idmenu","idmenu"); }
    public function cruds_menues() { return $this->hasMany(CrudsGeneradosMenues100::class,"idmenu","idmenu"); }

		
}
