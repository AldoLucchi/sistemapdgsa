<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuesAsignados101 extends Model
{
    use HasFactory;

    protected $table = "adm_menues_asignados";
	
	protected $fillable = [
        'idnmenuasignado','idmenu','idcliente','idrol','estatus','idproyecto','posicion',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idnmenuasignado';

    public $timestamps = false; 

	//relations
    
            public function Menues() { return $this->hasMany(Menues::class,"idmenu","idmenu"); }
                
            public function Clientes() { return $this->hasMany(Clientes::class,"idcliente","idcliente"); }
                
            public function UsuariosRoles() { return $this->hasMany(UsuariosRoles::class,"idrol","idrol"); }
                
            public function Proyectos() { return $this->hasMany(Proyectos::class,"idproyecto","idproyecto"); }

            public function menu() { return $this->belongsTo(Menues::class,"idmenu"); }
                
}
