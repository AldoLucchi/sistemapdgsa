<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactos4 extends Model
{
    use HasFactory;

    protected $table = "vtc_contactos";
	
	protected $fillable = [
        'idcontacto','nombre','telefono','celular','whatsapp','otrotelefono','correo','idorigendatos','fechanacimiento','idestadocivil','ingresofamiliar','idprovincia','idformacontacto','horario','idvendedor','idpaso',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idcontacto';

    public $timestamps = false; 

	//relations
    
                public function ContactosOrigenesdedatos() { return $this->hasMany(ContactosOrigenesdedatos::class,"idorigendatos","idorigendatos"); }
                    
                public function ContactosEstadocivil() { return $this->hasMany(ContactosEstadocivil::class,"idestadocivil","idestadocivil"); }
                    
                public function ContactosProvincias() { return $this->hasMany(ContactosProvincias::class,"idprovincia","idprovincia"); }
                    
                public function ContactosFormascontacto() { return $this->hasMany(ContactosFormascontacto::class,"idformacontacto","idformacontacto"); }
                    
                public function Users() { return $this->hasMany(Users::class,"id","idvendedor"); }
                    
                public function Pasos() { return $this->hasMany(Pasos::class,"idpaso","idpaso"); }
                    
}
