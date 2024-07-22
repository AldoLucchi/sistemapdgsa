<?php

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
class FirmaService
{

    public function getDataFirma($tableSelected = null, $idRegister = null)
    {

        $tables = DB::select('SHOW TABLES');

        $tables_firma = [];
        // $registers_firma = [];
        $register = null;
        $tables_in = 'Tables_in_'.env('DB_DATABASE');

        foreach ($tables as $i => $crud_table) {
            $table_name = $crud_table->$tables_in;

            $columns = DB::select("SHOW COLUMNS FROM " . $table_name);

            foreach ($columns as $column) {
                if ($column->Field == 'firma') {
                    $tables_firma[$table_name] = $table_name;

                    //$registers = DB::table($table_name)->get();
                    //$registers_firma[$table_name] = $registers;
                }
            }
        }

        $registerKey = '';
        $registerColumns = '';
        if ($tableSelected && $idRegister) {
            $registerColumns = DB::select("SHOW COLUMNS FROM " . $tableSelected);


            foreach ($registerColumns as $column) {
                if ($column->Key == 'PRI') {
                    $registerKey = $column->Field;
                }
            }
            $register = DB::table($tableSelected)->where($registerKey, $idRegister)->first();
        }

        $data = [
            'tables' => $tables_firma,
            //'registers' => $registers_firma
            'register' => $register,
            'registerKey' => $registerKey,
            'registerColumns' => $registerColumns,
        ];

        return  $data;
    }

    public function getDataRegistrarFirma($tableSelected, $idRegister)
    {
        $registerKey = '';
        $registerColumns = '';
        if ($tableSelected && $idRegister) {
            $registerColumns = DB::select("SHOW COLUMNS FROM " . $tableSelected);


            foreach ($registerColumns as $column) {
                if ($column->Key == 'PRI') {
                    $registerKey = $column->Field;
                }
            }
            $register = DB::table($tableSelected)->where($registerKey, $idRegister)->first();
        }

        $data = [
            'register' => $register,
            'registerKey' => $registerKey,
            'registerColumns' => $registerColumns,
        ];

        return  $data;
    }

    public function registrarFirmaGenerada($request)
    {
        Log::info('FirmaService - registrarFirmaGenerada');
        //Log::info($request);

        $tableSelected = $request['table'];
        $idRegister = $request['idRegister'];
        $firma = $request['firma'];
        $registerKey = '';
        $registerColumns = '';
        $nombreArchivo = '';
        $APP_URL = env('APP_URL');

        try {

            /*
            if ($request->hasFile('firma')) {
            $archivo = $request->file('firma');
            $nombreArchivo =  $this->functionsService->getCustomFilename($request['table'], $archivo->getClientOriginalName(), 'firma');
            Log::info($nombreArchivo);
            Storage::disk('images')->put($nombreArchivo, File::get($archivo));

            $request['nombreArchivo'] = $nombreArchivo;
            }
            */          

            if ($tableSelected && $idRegister) {
                $firmaExplode = explode(",", $firma);
                //Log::info($firmaExplode);

                $encoded_image = $firmaExplode[1];
                
                $decoded_image = base64_decode($encoded_image);
    
                $nombreArchivo = 'firmas/'.$tableSelected.'_'.$idRegister.'.png';
                $ruta_firma = public_path().'/images/'.$nombreArchivo ;
                file_put_contents($ruta_firma, $decoded_image);

                $registerColumns = DB::select("SHOW COLUMNS FROM " . $tableSelected);


                foreach ($registerColumns as $column) {
                    if ($column->Key == 'PRI') {
                        $registerKey = $column->Field;
                    }
                }
                $register = DB::table($tableSelected)->where($registerKey, $idRegister)->first();
                if ($register) {
                    
                    //$register->firma = $nombreArchivo;
                    //$register->save();

                    /*
                    $register->update([
                        'firma' => $nombreArchivo,
                    ]);
                    */
                    DB::table($tableSelected)->where($registerKey, $idRegister)->update(['firma' => $nombreArchivo ]);
                }

                return $nombreArchivo;
            }
        } catch (Exception $e) {
            Log::info('FirmaService - registrarFirmaGenerada - error' . $e->getMessage());
        }

        return false;
    }
}
