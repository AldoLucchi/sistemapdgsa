<?php

namespace App\Services;

use App\Models\Crud;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CrudService
{

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        Log::info('CrudServices - store');
        //dd($request);

        $table_name = $request['nombre'];
        $campos = '[';
        $table_fk_columns = DB::select("SHOW COLUMNS FROM " . $table_name);
        foreach ($table_fk_columns as $colum) {
            $incluir_campo = (isset($request[$table_name.'_'.$colum->Field])?1:0);
            $incluir_list = (isset($request[$table_name.'_'.$colum->Field.'_list'])?1:0);
            $alias = (isset($request[$table_name.'_'.$colum->Field.'_alias'])?$request[$table_name.'_'.$colum->Field.'_alias']:null);
            $select = (isset($request[$table_name.'_'.$colum->Field.'_select'])?$request[$table_name.'_'.$colum->Field.'_select']:null);
            $show_fk = (isset($request[$table_name.'_'.$colum->Field.'_show_fk'])?$request[$table_name.'_'.$colum->Field.'_show_fk']:null);
            $show_fk_permisos = (isset($request[$table_name.'_'.$colum->Field.'_show_fk_permisos'])?$request[$table_name.'_'.$colum->Field.'_show_fk_permisos']:null);
            if($show_fk_permisos){
                $show_fk_permisos = implode(',',$show_fk_permisos);
            }

            $campos .=  '{"field": "'.$colum->Field.'", "type": "'.$colum->Type.'", "null": "'.$colum->Null.'", "key": "'.$colum->Key.'", "default": "'.$colum->Default.'", "extra": "'.$colum->Extra.'", ';
            $campos .=  '"incluir_campo": '.$incluir_campo.', "incluir_list": '.$incluir_list.', "alias": "'.$alias.'",  "select": "'.$select.'",  "show_fk": "'.$show_fk.'",  "show_fk_permisos": "'.$show_fk_permisos.'" }, ';
        }
         $campos = substr($campos, 0, -1);
        $campos .= ']';

        //dd($campos);

        try {
            $crud = Crud::create([
                'nombre' => $request['nombre'],
                'alias_opcion' => $request['alias_opcion'],
                'alias_opcion_indivual' => $request['alias_opcion_individual'],
                'campos' => $campos,
            ]);

            $table_name_label = $this->getTableNameFormat($request['nombre']);
            $crud->nombre_componente = $table_name_label . $crud->id;
            $crud->save();

            Log::info($crud);

            return $crud;
        } catch (Exception $e) {
            Log::info('CrudServices - store - Exception ' . $e->getMessage());

            return false;
        }
    }

    public function getTableNameFormat($table_name)
    {
        $table_name_substr = substr($table_name, 4);
        if ($table_name == 'users') {
            $table_name_substr = $table_name;
        }
        $table_name_array = explode("_", $table_name_substr);
        $table_name_format = '';
        foreach ($table_name_array as $tring) {
            $table_name_format .= ucfirst($tring);
        }

        return $table_name_format;
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
