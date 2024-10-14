<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesosdirectos69 extends Model
{
    use HasFactory;

    protected $table = "vtc_accesosdirectos";

    protected $fillable = [
        'idaccesodirecto', 'titulo', 'idaccesodirectotipo', 'icono', 'url', 'idcrud', 'idrol', 'idusuario' 
        // 'idtipo',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'idaccesodirecto';

    public $timestamps = false;

    //relations

    public function CrudsGenerados()
    {
        return $this->hasMany(CrudsGenerados::class, "id", "idcrud");
    }

    public function CrudDetalle()
    {
        return $this->belongsTo(CrudsGenerados::class, "idcrud", "id");
    }
}
