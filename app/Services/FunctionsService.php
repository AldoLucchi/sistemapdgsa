<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FunctionsService
{

    public function getCustomFilename($recurso, $originalName, $urlAmigable)
    {
        $prefijo = strval(Carbon::now()->hour) . strval(Carbon::now()->minute) . strval(Carbon::now()->second);
        $nameOriginal = str_replace(" ", "", $originalName);
        $nameOriginal = substr($nameOriginal, 0, 15);
        $filename = $recurso . '_' . env('APP_ENV') . '_' . str_replace(" ", "", $urlAmigable) . '_' . $prefijo . '_' . $nameOriginal;
        return $filename;
    }
}
