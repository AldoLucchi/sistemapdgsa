<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'adm_cruds_generados';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'alias_opcion',
        'nombre_componente',
        'estatus',
        'alias_opcion_individual',
        'campos',
        'crud_permisos',
        'reglas',
        'reglas_sql',
        'row_url_custom',
    ];

    //relations

    public function CrudGeneradosMenues()
    {
        return $this->hasMany(CrudsGeneradosMenues100::class, "idcrudgen", "id");
    }
}
