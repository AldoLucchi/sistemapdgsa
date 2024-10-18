<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FunctionsService
{

    public function getCustomFilename($recurso, $originalName, $urlAmigable)
    {
        $prefijo = strval(Carbon::now()->hour) . strval(Carbon::now()->minute) . strval(Carbon::now()->second);
        Log::info('FunctionsService - getCustomFilename - ' . $originalName);
        $nameOriginal = str_replace(" ", "", $originalName);
        $nameOriginal = $this->filename_sanitizer($nameOriginal);
        Log::info('FunctionsService - getCustomFilename - ' . $nameOriginal);

        $nameOriginalArray = explode('.', $nameOriginal);
        $extensionOriginal = end($nameOriginalArray);
        $nameOriginal = substr($nameOriginal, 0, 15);
        $nameOriginal = $nameOriginal . '.' . $extensionOriginal;
        Log::info('FunctionsService - getCustomFilename - ' . $nameOriginal);

        $filename = $recurso . '_' . env('APP_ENV') . '_' . str_replace(" ", "", $urlAmigable) . '_' . $prefijo . '_' . $nameOriginal;
        return $filename;
    }

    function filename_sanitizer($unsafeFilename)
    {
        // our list of "unsafe characters", add/remove characters if necessary
        $dangerousCharacters = array(" ", '"', "'", "&", "/", "\\", "?", "#", "ñ", "Ñ", "á", "é", "í", "ó", "ú", "Á", "É", "Í", "Ó", "Ú", '[', ']', '/', '\\', '=', '<', '>', ':', ';', ',', '$', '#', '*', '~', '`', '!', '{', '}', '%', '+', '«', '»');

        // every forbidden character is replaced by an underscore
        $safe_filename = str_replace($dangerousCharacters, '_', $unsafeFilename);

        return $safe_filename;
    }
}
