<?php

namespace App\Services;

use App\Models\EtiquetasDocumentos104;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EtiquetaDocumentoService
{

    public function getValueAlias($alias, $id)
    {
        Log::info('EtiquetaDocumentoService - getValueAlias');
        Log::info('$alias ' . $alias . '  $id ' . $id);
        $etiquetaDocumento = EtiquetasDocumentos104::where('alias', $alias)->first();

        if ($etiquetaDocumento) {

            $table_columns = DB::select("SHOW COLUMNS FROM " . $etiquetaDocumento->tabla);
            $primary_key = '';
            $field_detail = [];
            $type_html = '';

            $fields_password_env = env('FIELDS_PASSWORD', 'password,clave');
            $fields_password = explode(',', $fields_password_env);

            $fields_media_env = env('FIELDS_MEDIA', 'imagen,logo,avatar,archivo,firma');
            $fields_media = explode(',', $fields_media_env);

            foreach ($table_columns as $colum) {
                if ($colum->Key == 'PRI') {
                    $primary_key = $colum->Field;
                }
                if ($colum->Field == $etiquetaDocumento->campo) {
                    $field_detail = [
                        'field' => $colum->Field,
                        'type' => $colum->Type,
                        'null' => $colum->Null,
                        'key' => $colum->Key,
                        'default' => $colum->Default,
                        'extra' => $colum->Extra,
                    ];

                    if (str_contains($colum->Type, 'tinyint')) {
                        $type_html = 'checkbox';
                    } else if (str_contains($colum->Type, 'varchar') &&   in_array(strtolower($colum->Field), $fields_password)) {
                        $type_html = 'password';
                    } else if (str_contains($colum->Type, 'varchar') &&   in_array(strtolower($colum->Field), $fields_media)) {
                        $type_html = 'file';
                    } else if (str_contains($colum->Type, 'varchar')) {
                        $type_html = 'text';
                    } else if (str_contains($colum->Type, 'timestamp')) {
                        $type_html = 'datetime-local';
                    } else if (str_contains($colum->Type, 'date')) {
                        $type_html = 'date';
                    } else if (str_contains($colum->Type, 'int')) {
                        $type_html = 'number';
                    } else if (str_contains($colum->Type, 'char')) {
                        $type_html = 'checkbox';
                    }
                }
            }


            $APP_URL = env('APP_URL');

            //Log::info($etiquetaDocumento);
            //Log::info($primary_key);
            //Log::info($field_detail);

            $campo = $etiquetaDocumento->campo;
            $campoResult = DB::table($etiquetaDocumento->tabla)->where($primary_key, $id)->select($campo)->first();

            if ($campoResult) {
                $campoValue = $campoResult->$campo;
                $campoFormat = $campoResult->$campo;

                if ($type_html == 'checkbox') {
                    if ($campoValue) {
                        $campoFormat = 'SI';
                    } else {
                        $campoFormat = 'NO';
                    }
                }
                if ($type_html == 'password') {
                    $campoFormat = '***';
                }
                if ($type_html == 'file') {
                    $path = $APP_URL . '/images/' . $campoValue;
                    $campoFormat = '<img src="' . $path . '">';
                }
                if ( in_array($type_html ,[ 'date','datetime-local']) ) {
                    $date = date_create($campoValue);
                    $campoFormat = date_format($date, "d/m/Y");
                }


                return $campoFormat;
            }
        }

        return null;
    }

    public function replaceVariables($html, $id)
    {
        $etiquetasDocumentos = EtiquetasDocumentos104::get();

        foreach ($etiquetasDocumentos as $etiquetaDocumento) {
            $etiquetaDocumentoValue = $this->getValueAlias($etiquetaDocumento->alias, $id);

            $html = str_replace('%' . $etiquetaDocumento->alias . '%', $etiquetaDocumentoValue, $html);
        }

        return $html;
    }
}
