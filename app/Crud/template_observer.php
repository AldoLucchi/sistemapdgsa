<?php

namespace App\Observers;

use App\Models\%OBJETO%;
use App\Services\BitacoraService;

class %OBJETO_OBSERVER%
{
    protected $bitacoraService;

    public function __construct(
        BitacoraService $bitacoraService,
    ) {
        $this->bitacoraService = $bitacoraService;
    }

    /**
     * Handle the %OBJETO% "created" event.
     */
    public function created(%OBJETO% $register): void
    {
        $sysdate = date('Y-m-d H:i:s');
        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        $data = [
            'crud' => '%OBJETO%',
            'tabla' => '%OBJETO_TABLE%',
            'id' => $register->%FIELD_ID%,
            'campoid' => '%FIELD_ID%',
            'idaccion' => 1,
            'descripcion' => 'Registro insertado',
            'idproyecto' => ($register->idproyecto ? $register->idproyecto : 0),
            'idcliente' => ($register->idcliente ? $register->idcliente : 0),
            'ip' =>  $ip,
            'fecha' => $sysdate,
        ];

        $this->bitacoraService->insertBitacora($data);
    }

    /**
     * Handle the %OBJETO% "updated" event.
     */
    public function updated(%OBJETO% $register): void
    {
        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        $sysdate = date('Y-m-d H:i:s');

        $data = [
            'crud' => '%OBJETO%',
            'tabla' => '%OBJETO_TABLE%',
            'id' => $register->%FIELD_ID%,
            'campoid' => '%FIELD_ID%',
            'idaccion' => 1,
            'descripcion' => 'Registro insertado',
            'idproyecto' => ($register->idproyecto ? $register->idproyecto : 0),
            'idcliente' => ($register->idcliente ? $register->idcliente : 0),
            'ip' =>  $ip,
            'fecha' => $sysdate,
        ];

        $this->bitacoraService->insertBitacora($data);
    }

    /**
     * Handle the %OBJETO% "deleted" event.
     */
    public function deleted(%OBJETO% $register): void
    {
        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        $sysdate = date('Y-m-d H:i:s');

        $data = [
            'crud' => '%OBJETO%',
            'tabla' => '%OBJETO_TABLE%',
            'id' => $register->%FIELD_ID%,
            'campoid' => '%FIELD_ID%',
            'idaccion' => 1,
            'descripcion' => 'Registro insertado',
            'idproyecto' => ($register->idproyecto ? $register->idproyecto : 0),
            'idcliente' => ($register->idcliente ? $register->idcliente : 0),
            'ip' =>  $ip,
            'fecha' => $sysdate,
        ];

        $this->bitacoraService->insertBitacora($data);
    }

    /**
     * Handle the %OBJETO% "restored" event.
     */
    public function restored(%OBJETO% $register): void
    {
        //
    }

    /**
     * Handle the %OBJETO% "force deleted" event.
     */
    public function forceDeleted(%OBJETO% $register): void
    {
        //
    }
}
