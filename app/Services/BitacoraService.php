<?php

namespace App\Services;

use App\Models\Bitacora71;

class BitacoraService
{


    public function insertBitacora($data)
    {
        $bitacora = Bitacora71::create($data);

        return $bitacora;
    }
}