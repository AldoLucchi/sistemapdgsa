<?php

namespace App\Services;

use App\Models\Crud;
use Exception;
use Illuminate\Support\Facades\Log;

class CrudService
{

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        Log::info('CrudServices - store');

        try {
            $crud = Crud::create([
                'nombre' => $request['nombre'],
                'alias_opcion' => $request['alias_opcion'],
            ]);

            $table_name_substr = substr($request['nombre'], 4);
            if ($request['nombre'] == 'users') {
                $table_name_substr = $request['nombre'];
            }
            $table_name_array = explode("_", $table_name_substr);
            $table_name_format = '';
            foreach ($table_name_array as $tring) {
                $table_name_format .= ucfirst($tring);
            }

            $table_name_label = $table_name_format;
            $table_name_format = $table_name_format . $crud->id;
            $crud->nombre_componente = $table_name_format;
            $crud->save();            

            Log::info($crud);

            return $crud;
        } catch (Exception $e) {
            Log::info('CrudServices - store - Exception ' . $e->getMessage());

            return false;
        }
    }

    /**
     * Update
     */
    public function update($request, $id)
    {
        Log::info('CrudServices - update');

        try {
            $crud = Crud::find($id);
            
            $crud->alias_opcion = $request['alias_opcion'];
            $crud->estatus = $request['estatus'];
            $crud->save();            

            Log::info($crud);

            return $crud;
        } catch (Exception $e) {
            Log::info('CrudServices - update - Exception ' . $e->getMessage());

            return false;
        }
    }
}
