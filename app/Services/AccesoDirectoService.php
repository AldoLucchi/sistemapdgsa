<?php

namespace App\Services;

use App\Models\Accesosdirectos69;

class AccesoDirectoService
{
    public function getAccesoDirectos()
    {
        $accesosDirectos = Accesosdirectos69::orderBy('idcrud', 'ASC')
        ->with('CrudDetalle')
        ->get();
        return $accesosDirectos;
    }
}
