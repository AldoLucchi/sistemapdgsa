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
            $incluir_campo = (isset($request[$table_name . '_' . $colum->Field]) ? 1 : 0);
            $incluir_list = (isset($request[$table_name . '_' . $colum->Field . '_list']) ? 1 : 0);
            $indice = (isset($request[$table_name . '_' . $colum->Field . '_indice']) ? $request[$table_name . '_' . $colum->Field . '_indice'] : 99);
            $alias = (isset($request[$table_name . '_' . $colum->Field . '_alias']) ? $request[$table_name . '_' . $colum->Field . '_alias'] : '');
            $help = (isset($request[$table_name . '_' . $colum->Field . '_help']) ? $request[$table_name . '_' . $colum->Field . '_help'] : '');

            $regex = (isset($request[$table_name . '_' . $colum->Field . '_regex']) ? $request[$table_name . '_' . $colum->Field . '_regex'] : '');
            $regex = urlencode($regex);
            $maxlength = (isset($request[$table_name . '_' . $colum->Field . '_maxlength']) ? $request[$table_name . '_' . $colum->Field . '_maxlength'] : null);
            $required = (isset($request[$table_name . '_' . $colum->Field . '_required']) ? 1 : 0);
            $readonly = (isset($request[$table_name . '_' . $colum->Field . '_readonly']) ? 1 : 0);
            $hidden = (isset($request[$table_name . '_' . $colum->Field . '_hidden']) ? 1 : 0);

            $crud_anidado_rules = (isset($request[$table_name . '_' . $colum->Field . '_crud_anidado_rules']) ? $request[$table_name . '_' . $colum->Field . '_crud_anidado_rules'] : '');
            $dependiente_oculto_rules = (isset($request[$table_name . '_' . $colum->Field . '_dependiente_oculto_rules']) ? $request[$table_name . '_' . $colum->Field . '_dependiente_oculto_rules'] : '');

            $select = (isset($request[$table_name . '_' . $colum->Field . '_select']) ? $request[$table_name . '_' . $colum->Field . '_select'] : null);
            $style_color = (isset($request[$table_name . '_' . $colum->Field . '_style_color']) ? $request[$table_name . '_' . $colum->Field . '_style_color'] : '');
            $anidado = (isset($request[$table_name . '_' . $colum->Field . '_anidado']) ? $request[$table_name . '_' . $colum->Field . '_anidado'] : null);
            $select_rules = (isset($request[$table_name . '_' . $colum->Field . '_select_rules']) ? $request[$table_name . '_' . $colum->Field . '_select_rules'] : null);

            $show_fk = (isset($request[$table_name . '_' . $colum->Field . '_show_fk']) ? $request[$table_name . '_' . $colum->Field . '_show_fk'] : null);
            $show_fk_permisos = (isset($request[$table_name . '_' . $colum->Field . '_show_fk_permisos']) ? $request[$table_name . '_' . $colum->Field . '_show_fk_permisos'] : null);
            if ($show_fk_permisos) {
                $show_fk_permisos = implode(',', $show_fk_permisos);
            }

            $campos .=  '{"field": "' . $colum->Field . '", "type": "' . $colum->Type . '", "null": "' . $colum->Null . '", "key": "' . $colum->Key . '", "default": "' . $colum->Default . '", "extra": "' . $colum->Extra . '", ';
            $campos .=  '"incluir_campo": ' . $incluir_campo . ', "incluir_list": ' . $incluir_list . ', "indice": ' . $indice . ', "alias": "' . $alias . '", "help": "' . $help . '", ';
            $campos .= '"required": ' . $required  . ', "readonly": ' . $readonly . ', "hidden": ' . $hidden . ', "maxlength": "' . $maxlength . '", "regex": "' . $regex . '", "style_color": "' . $style_color . '",';
            $campos .=  '"select": "' . $select . '",  "anidado": "' . $anidado . '",  "select_rules": "' . $select_rules . '",';
            $campos .=  '"crud_anidado_rules": "' . $crud_anidado_rules . '", "dependiente_oculto_rules": "' . $dependiente_oculto_rules . '",';
            $campos .=  '"show_fk": "' . $show_fk . '",  "show_fk_permisos": "' . $show_fk_permisos . '" },';
        }
        $campos = substr($campos, 0, -1);
        $campos .= ']';

        Log::info('CrudServices - store - campos');
        Log::info($campos);

        if (!json_validate($campos)) {
            return false;
        }

        $crud = null;
        $crud_permisos = '';

        if (isset($request['crud_permisos']) && $request['crud_permisos']) {
            $crud_permisos = implode(',', $request['crud_permisos']);
        }

        $data = [
            'nombre' => $request['nombre'],
            'alias_opcion' => $request['alias_opcion'],
            'alias_opcion_individual' => $request['alias_opcion_individual'],
            'status' => $request['estatus'],
            'crud_permisos' => $crud_permisos,
            'reglas' => $request['reglas'],
            'row_url_custom' => $request['row_url_custom'],
            'campos' => $campos,
        ];

        try {
            if (isset($request['crud_id'])) {
                $crud = Crud::find($request['crud_id']);
                $crudUpdate = $crud->update($data);
            } else {
                $crud = Crud::create($data);

                $table_name_label = $this->getTableNameFormat($request['nombre']);
                $crud->nombre_componente = $table_name_label . $crud->id;
                $crud->save();
            }
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
