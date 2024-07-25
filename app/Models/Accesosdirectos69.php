<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accesosdirectos69 extends Model
{
    use HasFactory;

    protected $table = "vtc_accesosdirectos";

    protected $fillable = [
        'idaccesodirecto', 'titulo', 'idtipo', 'icono', 'url', 'idcrud',
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
}
