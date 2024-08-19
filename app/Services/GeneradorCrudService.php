<?php

namespace App\Services;

use App\Models\Crud;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneradorCrudService
{

    public function getTableName($table_name)
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

        return  $table_name_format;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        Log::info('GeneradorCrudServices - store');
        Log::info($request);

        try {
            $table_name_label = $this->getTableName($request['nombre']);
            $crud_name_format = $table_name_label . $request['crud_id'];

            $table_crud = $request['nombre'];
            $alias_opcion = $request['alias_opcion'];
            $alias_opcion_individual = $request['alias_opcion_individual'];
            $rules = $request['reglas'];
            $crud_permisos =  null;
            if (isset($request['crud_permisos']) && $request['crud_permisos']) {
                if (is_string($request['crud_permisos'])) {
                    $crud_permisos = explode(',', $request['crud_permisos']);
                }
                if (is_array($request['crud_permisos'])) {
                    $crud_permisos = $request['crud_permisos'];
                }
            }

            $crud_permisos_create = true;
            $crud_permisos_read = true;
            $crud_permisos_update = true;
            $crud_permisos_delete = true;
            if (isset($crud_permisos) && $crud_permisos) {
                if (!in_array('create', $crud_permisos)) {
                    $crud_permisos_create = false;
                }
                if (!in_array('read', $crud_permisos)) {
                    $crud_permisos_read = false;
                }
                if (!in_array('update', $crud_permisos)) {
                    $crud_permisos_update = false;
                }
                if (!in_array('delete', $crud_permisos)) {
                    $crud_permisos_delete = false;
                }
            }

            $table_crud_columns = DB::select("SHOW COLUMNS FROM " . $table_crud);
            $table_columns_string = "";

            $table_columns = $table_columns_include_all = [];
            $all_columns_include = true;
            $table_columns_include_all_string = '';
            $table_column_id = '';
            $table_column_name = '';
            $k = 1;

            $tables_fk = [];
            $tables_crud_relation_fk = [];
            foreach ($table_crud_columns as $colum) {
                $column_select_indice = $table_crud . '_' . $colum->Field . '_indice';
                $column_request_include = $table_crud . '_' . $colum->Field;
                $column_select_list = $table_crud . '_' . $colum->Field . '_list';
                $column_select_alias = $table_crud . '_' . $colum->Field . '_alias';
                $column_select_help = $table_crud . '_' . $colum->Field . '_help';

                $column_select_readonly = $table_crud . '_' . $colum->Field . '_readonly';
                $column_select_required = $table_crud . '_' . $colum->Field . '_required';
                $column_select_regex = $table_crud . '_' . $colum->Field . '_regex';
                $column_select_maxlength = $table_crud . '_' . $colum->Field . '_maxlength';

                $column_select_request = $table_crud . '_' . $colum->Field . '_select';
                $column_select_anidado = $table_crud . '_' . $colum->Field . '_anidado';
                $column_select_rules = $table_crud . '_' . $colum->Field . '_select_rules';

                $column_select_crud_anidado_rules = $table_crud . '_' . $colum->Field . '_crud_anidado_rules';

                $column_show_fk = $table_crud . '_' . $colum->Field . '_show_fk';
                $column_show_fk_permisos = $table_crud . '_' . $colum->Field . '_show_fk_permisos';

                $type_html = 'text'; //varchar text

                $fields_password_env = env('FIELDS_PASSWORD', 'password,clave');
                $fields_password = explode(',', $fields_password_env);

                $fields_media_env = env('FIELDS_MEDIA', 'imagen,logo,avatar,archivo');
                $fields_media = explode(',', $fields_media_env);

                $fields_doc_env = env('FIELDS_DOC', 'documento,doc,pdf');
                $fields_doc = explode(',', $fields_doc_env);

                if (str_contains($colum->Type, 'tinyint')) {
                    $type_html = 'checkbox';
                } else if (str_contains($colum->Type, 'varchar') &&   in_array(strtolower($colum->Field), $fields_password)) {
                    $type_html = 'password';
                } else if (str_contains($colum->Type, 'varchar') &&   in_array(strtolower($colum->Field), $fields_media)) {
                    $type_html = 'file';
                } else if (str_contains($colum->Type, 'text') &&   in_array(strtolower($colum->Field), $fields_doc)) {
                    $type_html = 'html';
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
                } else {
                    $type_html = 'text';
                }

                //type
                $table_column_detail = [
                    'name' => $colum->Field,
                    'type' => $colum->Type,
                    'type_html' => $type_html
                ];

                //indice
                if (isset($request[$column_select_indice]) && !empty($request[$column_select_indice]) &&  $column_select_indice && $column_select_indice != 'NULL' && $column_select_indice != NULL) {
                    $table_column_detail['indice'] = $request[$column_select_indice];
                } else {
                    $table_column_detail['indice'] = 99;
                }

                //in list
                if (isset($request[$column_select_list]) && !empty($request[$column_select_list]) &&  $column_select_list && $column_select_list != 'NULL' && $column_select_list != NULL) {
                    $table_column_detail['incluir_list'] = $request[$column_select_list];
                }

                //readonly
                if (isset($request[$column_select_readonly]) && !empty($request[$column_select_readonly]) &&  $column_select_readonly && $column_select_readonly != 'NULL' && $column_select_readonly != NULL) {
                    $table_column_detail['readonly'] = $request[$column_select_readonly];
                }

                //required
                if (isset($request[$column_select_required]) && !empty($request[$column_select_required]) &&  $column_select_required && $column_select_required != 'NULL' && $column_select_required != NULL) {
                    $table_column_detail['required'] = $request[$column_select_required];
                }

                //alias
                if (isset($request[$column_select_alias]) && !empty($request[$column_select_alias]) &&  $column_select_alias && $column_select_alias != 'NULL' && $column_select_alias != NULL) {
                    $table_column_detail['alias'] = $request[$column_select_alias];
                }

                //help
                if (isset($request[$column_select_help]) && !empty($request[$column_select_help]) &&  $column_select_help && $column_select_help != 'NULL' && $column_select_help != NULL) {
                    $table_column_detail['help'] = $request[$column_select_help];
                }

                //regex
                if (isset($request[$column_select_regex]) && !empty($request[$column_select_regex]) &&  $column_select_regex && $column_select_regex != 'NULL' && $column_select_regex != NULL) {
                    $table_column_detail['regex'] = $request[$column_select_regex];
                }

                //maxlength
                if (isset($request[$column_select_maxlength]) && !empty($request[$column_select_maxlength]) &&  $column_select_maxlength && $column_select_maxlength != 'NULL' && $column_select_maxlength != NULL) {
                    $table_column_detail['maxlength'] = $request[$column_select_maxlength];
                }

                //fk
                if (isset($request[$column_select_request]) && !empty($request[$column_select_request]) &&  $column_select_request && $column_select_request != 'NULL' && $column_select_request != NULL) {
                    $table_column_detail['select'] = $request[$column_select_request];
                    $tables_fk[$colum->Field] = $request[$column_select_request];


                    if (isset($request[$column_select_anidado]) && !empty($request[$column_select_anidado]) &&  $column_select_anidado && $column_select_anidado != 'NULL' && $column_select_anidado != NULL) {
                        $table_column_detail['anidado'] = $request[$column_select_anidado];
                    }

                    if (isset($request[$column_select_rules]) && !empty($request[$column_select_rules]) &&  $column_select_rules && $column_select_rules != 'NULL' && $column_select_rules != NULL) {
                        $table_column_detail['select_rules'] = $request[$column_select_rules];
                    }


                    if (isset($request[$column_select_crud_anidado_rules]) && !empty($request[$column_select_crud_anidado_rules]) &&  $column_select_crud_anidado_rules && $column_select_crud_anidado_rules != 'NULL' && $column_select_crud_anidado_rules != NULL) {
                        $table_column_detail['crud_anidado_rules'] = $request[$column_select_crud_anidado_rules];
                    }

                    //
                    if (isset($request[$column_show_fk]) && !empty($request[$column_show_fk]) &&  $column_show_fk && $column_show_fk != 'NULL' && $column_show_fk != NULL) {
                        $table_column_detail['select_crud_relation'] = $request[$column_show_fk];
                        $tables_crud_relation_fk[$colum->Field]['crud'] = $request[$column_show_fk];
                        if (isset($request[$column_show_fk_permisos]) && !empty($request[$column_show_fk_permisos]) &&  $column_show_fk_permisos && $column_show_fk_permisos != 'NULL' && $column_show_fk_permisos != NULL) {
                            $table_column_detail['select_crud_relation_permisos'] = $request[$column_show_fk_permisos];
                            $tables_crud_relation_fk[$colum->Field]['permisos'] = $request[$column_show_fk_permisos];
                        }
                    }
                }

                //incude field
                if (isset($request[$column_request_include]) && $request[$column_request_include]) {
                    $table_columns[] =  $table_column_detail;
                    $table_columns_string .= "'" . $colum->Field . "',";
                }
                else {
                    $all_columns_include = false;
                }

                //pk
                if ($colum->Key == 'PRI') {
                    $table_column_id = $colum->Field;
                }

                //name
                if ($k == 2) {
                    $table_column_name = $colum->Field;
                }

                $k++;

                //all                
                $table_columns_include_all[] = $table_column_detail;
                $table_columns_include_all_string .= "'" . $colum->Field . "',";
            }
            // all columns o selected columns
            if ($all_columns_include) {
                $table_columns =  $table_columns_include_all;
                $table_columns_string = $table_columns_include_all_string;
            }


            //fk tables----
            $tables_data_fk = [];
            foreach ($tables_fk as $key => $table_fk) {
                $table_fk_columns = DB::select("SHOW COLUMNS FROM " . $table_fk);
                $table_columns_all_string = '';
                $table_column_fk_id = '';
                $table_column_fk_name = '-';
                $table_column_fk_idcliente = false;
                $table_column_fk_idproyecto = false;
                $i = 1;

                //column id and name fk
                foreach ($table_fk_columns as $colum) {
                    $table_columns_all_string .= "'" . $colum->Field . "',";
                    if ($colum->Key == 'PRI') {
                        $table_column_fk_id = $colum->Field;
                    }
                    if ($i == 2) {
                        $table_column_fk_name = $colum->Field;
                    }
                    if ($colum->Field == 'idproyecto') {
                        $table_column_fk_idproyecto = true;
                    }
                    if ($colum->Field == 'idcliente') {
                        $table_column_fk_idcliente = true;
                    }
                    $i++;
                }

                //name table fk
                $table_name_fk_substr = substr($table_fk, 4);
                if ($table_fk == 'users') {
                    $table_name_fk_substr = $table_fk;
                }

                //name table fk format
                $table_name_fk_array = explode("_", $table_name_fk_substr);
                $table_name_fk_format = '';
                foreach ($table_name_fk_array as $tring) {
                    $table_name_fk_format .= ucfirst($tring);
                }

                //crud relation
                //$crud_relation =

                //data fk
                $table_fk_data = [
                    'table_fullname_fk' => $table_fk,
                    'table_name_fk' => $table_name_fk_format,
                    'table_columns_string_fk' => $table_columns_all_string,
                    'table_column_fk_id' => $table_column_fk_id,
                    'table_column_fk_name' => $table_column_fk_name,
                    'table_column_fk_idcliente' => $table_column_fk_idcliente,
                    'table_column_fk_idproyecto' => $table_column_fk_idproyecto,
                    'model_name' => $table_name_fk_format,
                ];

                $tables_data_fk[$key] =  $table_fk_data;
            }

            $data = [
                'table_fullname' => $table_crud,
                'crud_name' => $crud_name_format,
                'table_name_label' => $table_name_label,
                'table_name_label_alias' => $alias_opcion,
                'table_name_label_individual' => $alias_opcion_individual,
                'rules' => $rules,
                'crud_permisos' => $crud_permisos,
                'crud_permisos_create' => $crud_permisos_create,
                'crud_permisos_read' => $crud_permisos_read,
                'crud_permisos_update' => $crud_permisos_update,
                'crud_permisos_delete' => $crud_permisos_delete,
                'table_columns' =>  $table_columns,
                'table_columns_string' =>  $table_columns_string,
                'table_column_id' => $table_column_id,
                'table_column_name' => $table_column_name,
                'tables_fk' => $tables_data_fk,
                'tables_crud_relation_fk' => $tables_crud_relation_fk,
                'model_name' => $crud_name_format,
                'controller_name' => $crud_name_format . 'Controller',
                'datatable_name' => $crud_name_format . 'DataTable',
                'observer_name' => $crud_name_format . 'Observer',
                'service_name' => $crud_name_format . 'Service',
            ];

            Log::info($data);

            $this->generateCrud($data);

            return true;
        } catch (Exception $e) {
            Log::info('GeneradorCrudService - store - Exception ' . $e->getMessage());

            return false;
        }
    }

    public function generateCrud($data)
    {
        $this->generateCrudModelFK($data);
        $this->generateCrudModel($data);
        $this->generateCrudObserver($data);
        $this->generateCrudController($data);
        $this->generateCrudViews($data);
        $this->generateCrudDatatable($data);
        $this->generateCrudLivewire($data);
        $this->generateCrudRelations($data);

        $this->generateCrudRoute($data);
        //$this->generateCrudMenu($data);
        //$this->generateCrudBreadcrumb($data);

        $this->limpiarCache();
    }

    public function generateCrudModelFK($data)
    {
        //create model fk

        foreach ($data['tables_fk'] as $table) {
            $model_exist = file_exists("../app/Models/" . $table['model_name'] . ".php");
            if (!$model_exist) {
                $file = fopen("../app/Models/" . $table['model_name'] . ".php", "w") or die("Unable to open file - Model " . $table['model_name']);
                $data['objeto_fk'] = $table['model_name'];
                $data['tabla_fk'] = $table['table_fullname_fk'];
                $data['tabla_campos_fk'] = $table['table_columns_string_fk'];
                $data['tabla_id_fk'] = $table['table_column_fk_id'];

                $template = file_get_contents('../app/Crud/template_model_fk.php');
                $template = $this->generateCrudReplace($template, $data);
                fwrite($file, $template);
                fclose($file);
            }
        }
    }

    public function generateCrudModel($data)
    {
        //create model  

        $file_model = fopen("../app/Models/" . $data['model_name'] . ".php", "w") or die("Unable to open file - Model " . $data['model_name']);
        $template_model = file_get_contents('../app/Crud/template_model.php');
        $template_model = $this->generateCrudReplace($template_model, $data);

        $relations = '';
        $relations_array = [];

        foreach ($data['tables_fk'] as $key => $table) {
            if (!in_array($table['table_name_fk'], $relations_array)) {
                $relation = '';

                if ($table['table_name_fk'] == 'Users') {
                    $relation = '
                public function ' . $table['table_name_fk'] . '() { return $this->hasMany(' . $table['model_name'] . '::class,"id","' . $key . '"); }
                    ';
                } else {
                    $relation = '
                public function ' . $table['table_name_fk'] . '() { return $this->hasMany(' . $table['model_name'] . '::class,"' . $key . '","' . $key . '"); }
                    ';
                }

                $relations .=  $relation;
                $relations_array[] = $table['table_name_fk'];
            }
        }

        $template_model = str_replace('%RELATIONS%', $relations, $template_model);


        fwrite($file_model, $template_model);
        fclose($file_model);
    }

    public function generateCrudObserver($data)
    {
        Log::info('GeneradorCrudService - generateCrudObserver');

        $file = fopen("../app/Observers/" . $data['observer_name'] . ".php", "w") or die("Unable to open file - Observer " . $data['observer_name']);
        $template = file_get_contents('../app/Crud/template_observer.php');
        $template = $this->generateCrudReplace($template, $data);

        fwrite($file, $template);
        fclose($file);

        $AppServiceProvider = file_get_contents('../app/Providers/AppServiceProvider_observer.php');
        //Log::info($AppServiceProvider);
        //Log::info($data['observer_name']);

        if (!str_contains($AppServiceProvider, $data['observer_name'])) {
            $data_observer = '
            use App\Models\\' . $data['model_name'] . ';
            use App\Observers\\' . $data['observer_name'] . ';
            
            ' . $data['model_name'] . '::observe(' . $data['observer_name'] . '::class);

            //%NEW_OBSERVER%
            ';

            $AppServiceProvider = str_replace("//%NEW_OBSERVER%", $data_observer, $AppServiceProvider);

            $fileAppServiceProvider = fopen("../app/Providers/AppServiceProvider_observer.php", "w") or die("Unable to open file - AppServiceProvider_observer ");
            fwrite($fileAppServiceProvider, $AppServiceProvider);
            fclose($fileAppServiceProvider);
        }
    }

    public function generateCrudController($data)
    {
        Log::info('GeneradorCrudService - generateCrudController');

        //create controller

        //create dir 
        if (!is_dir("../app/Http/Controllers/Crud/")) {
            mkdir("../app/Http/Controllers/Crud/");
        }

        $file_controller = fopen("../app/Http/Controllers/Crud/" . $data['controller_name'] . ".php", "w") or die("Unable to open file - controller " . $data['controller_name']);
        $template_controller = file_get_contents('../app/Crud/template_controller.php');
        $template_controller = $this->generateCrudReplace($template_controller, $data);

        $file_service = fopen("../app/Services/Crud/" . $data['service_name'] . ".php", "w") or die("Unable to open file - service " . $data['service_name']);
        $template_service = file_get_contents('../app/Crud/template_service.php');
        $template_service = $this->generateCrudReplace($template_service, $data);

        $template_controller_file = file_get_contents('../app/Crud/template_controller_file.php');

        $tablas_asociadas_uses = '';
        $tablas_asociadas_get = '';
        $tablas_asociadas = '';
        $models_array = [];

        $fields_checkobx = '';

        $field_file_storage = '';
        $pdf = '';
        $filtersControllerIndex = '';

        $template_filters = '
            if(isset($request["%OBJETO_VARIABLE%"]) ){
                $filters["%OBJETO_VARIABLE%"]=$request["%OBJETO_VARIABLE%"];
            }
            else{
                $request["%OBJETO_VARIABLE%"]="";
            }	    
        ';

        $filters_variables = '';
        $template_filters_variables_all = '
            "%OBJETO_VARIABLE%List" => $%OBJETO_VARIABLE%,
        ';

        $template_filters_variables = '
            "%OBJETO_VARIABLE%" => $request["%OBJETO_VARIABLE%"],
        ';

        $insert_crud_anidados = '';
        $variables_crud_anidados = '';

        foreach ($data['table_columns'] as $column) {
            if ($column['type_html'] == 'checkbox') {
                $field_checkbox = '
                $request["' . $column['name'] . '"] = ( isset($request["' . $column['name'] . '"])?1:0); 
                ';
                $fields_checkobx .= $field_checkbox;
            }
            if (isset($column['select'])) {
                $filter = $template_filters;
                $filter_variable = $template_filters_variables;
                $filter_variable_all = $template_filters_variables_all;

                $model_name_fk = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name_fk = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id_fk = $data['tables_fk'][$column['name']]['table_column_fk_id'];
                $column_idcliente_fk = $data['tables_fk'][$column['name']]['table_column_fk_idcliente'];
                $column_idproyecto_fk = $data['tables_fk'][$column['name']]['table_column_fk_idproyecto'];

                if (!in_array($model_name_fk, $models_array)) {
                    $use_model = '
                    use App\Models\\' . $model_name_fk . ';
                    ';
                    $models_array[] = $model_name_fk;
                }
                else{
                    $use_model = '';
                }

                $tabla_get = '
                $' . $model_name_fk . ' = \App\Models\\' . $model_name_fk . '::select("*"); 
                ';

                if (isset($column['select_rules'])) {
                    $select_rules_array = explode(';', $column['select_rules']);
                    foreach ($select_rules_array as $rule) {
                        $rule_array = explode(',', $rule);
                        $tabla_get  .= '
                            $' . $model_name_fk . ' = $' . $model_name_fk . '->where("' . $rule_array[0] . '", "' . $rule_array[1] . '","' . $rule_array[2] . '");
                        ';
                    }
                    //$condition = 'whereIn("' . $column_id_fk . '",[' . $column['select_rules'] . '])';
                }


                if ($column_idcliente_fk) {
                    $tabla_get  .= '
                    if(session()->get("idcliente")){
                        $' . $model_name_fk . ' = $' . $model_name_fk . '->where("idcliente", session()->get("idcliente") );
                    }
                    ';
                }

                if ($column_idproyecto_fk) {
                    $tabla_get  .= '
                    if(session()->get("idproyecto")){
                        $' . $model_name_fk . ' = $' . $model_name_fk . '->where("idproyecto", session()->get("idproyecto") );
                    }
                    ';
                }

                $tabla_get  .= '
                $' . $model_name_fk . ' = $' . $model_name_fk . '->orderBy("' . $column_name_fk . '","ASC")
                ->get();
                ';

                $tabla_add = '
                "' . $model_name_fk . '" => $' . $model_name_fk . ', 
                ';


                if (isset($column['crud_anidado_rules']) && $column['crud_anidado_rules']) {
                    $variables_crud_anidados = $this->getVariablesCrudAnidadoController($column['crud_anidado_rules']);

                    $insert_crud_anidados = $this->getInsertCrudAnidadoController($column['crud_anidado_rules']);
                }


                $tablas_asociadas_uses .= $use_model;
                $tablas_asociadas_get .= $tabla_get;
                $tablas_asociadas .= $tabla_add;

                //filter
                $filter = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter);
                $filtersControllerIndex .= $filter;

                $filter_variable = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter_variable);
                $filters_variables .= $filter_variable;

                $filter_variable_all = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter_variable_all);
                //$filter_variable_all = str_replace('%VARIABLE_CONDITION%', $condition, $filter_variable_all);
                $filters_variables .= $filter_variable_all;
            }
            if (in_array($column['type_html'], ['date', 'datetime-local'])) {
                $date_name = $column['name'];
                $date_from = $column['name'] . '_from';
                $date_to = $column['name'] . '_to';

                $filter_from = $template_filters;
                $filter_variable_from = $template_filters_variables;

                //filter from
                $filter_from = str_replace('%OBJETO_VARIABLE%', $date_from, $filter_from);
                $filtersControllerIndex .= $filter_from;

                $filter_variable_from = str_replace('%OBJETO_VARIABLE%', $date_from, $filter_variable_from);
                $filters_variables .= $filter_variable_from;

                //filter to

                $filter_to = $template_filters;
                $filter_variable_to = $template_filters_variables;

                $filter_to = str_replace('%OBJETO_VARIABLE%', $date_to, $filter_to);
                $filtersControllerIndex .= $filter_to;

                $filter_variable_to = str_replace('%OBJETO_VARIABLE%', $date_to, $filter_variable_to);
                $filters_variables .= $filter_variable_to;
            }
            if ($column['type_html'] == 'file') {
                $template_file = $template_controller_file;
                $template_file = $this->generateCrudReplace($template_file, $data);
                $template_file = str_replace('%FIELD%', $column['name'], $template_file);

                $field_file_storage .= $template_file;
            }

            if ($column['type_html'] == 'html') {
                $use_model = '
                use App\Models\EtiquetasDocumentos104;
                ';
                $tabla_add = '
                "etiquetasDocumentos" => EtiquetasDocumentos104::orderBy("alias","ASC")->get(), 
                ';

                $tablas_asociadas_uses .= $use_model;
                $tablas_asociadas .= $tabla_add;
            }
        }


        $template_controller = str_replace('%FIELD_CHECKBOX%', $fields_checkobx, $template_controller);

        $template_controller = str_replace('%FIELD_FILE_STORAGE%', $field_file_storage, $template_controller);
        $template_controller = str_replace('%FILTERS_CONTROLLER_INDEX%', $filtersControllerIndex, $template_controller);
        $template_controller = str_replace('%FILTERS_VARIABLES_GET%', $tablas_asociadas_get, $template_controller);
        $template_controller = str_replace('%FILTERS_VARIABLES%', $filters_variables, $template_controller);
        $template_controller = str_replace('%FIELD_PDF%', $pdf, $template_controller);
        $template_controller = str_replace('%CONTROLLER_VARIABLES_ANIDADOS%', $variables_crud_anidados, $template_controller);
        $template_controller = str_replace('%CONTROLLER_INSERT_ANIDADOS%', $insert_crud_anidados, $template_controller);

        fwrite($file_controller, $template_controller);
        fclose($file_controller);

        $template_service = str_replace('%TABLAS_ASOCIADAS_USE%', $tablas_asociadas_uses, $template_service);
        $template_service = str_replace('%TABLAS_ASOCIADAS_GET%', $tablas_asociadas_get, $template_service);
        $template_service = str_replace('%TABLAS_ASOCIADAS%', $tablas_asociadas, $template_service);

        fwrite($file_service, $template_service);
        fclose($file_service);
    }


    public function getVariablesCrudAnidadoController($rules)
    {
        Log::info('GeneradorCrudService - getVariablesCrudAnidadoController');
        Log::info($rules);

        $rules = explode(';', $rules);

        $variables = '';

        foreach ($rules as $rule) {
            if ($rule) {
                $items = explode(',', $rule);
                $operator_field = $items[0];
                $operator_value = $items[2];
                $crud_asociado_id = $items[3];
                $crud_cantidad_registros = $items[4];

                $crud = Crud::find($crud_asociado_id);

                if ($crud) {
                    $variables .= '
                    $' . $crud->nombre_componente . 'Service = new \App\Services\Crud\\' . $crud->nombre_componente . 'Service();
                    $data' . $crud->nombre_componente . ' = $' . $crud->nombre_componente . 'Service->getData();

                    $data =  array_merge($data, $data' . $crud->nombre_componente . ');
                    ';
                }
            }
        }

        return $variables;
    }

    public function getInsertCrudAnidadoController($rules)
    {
        Log::info('GeneradorCrudService - getInsertCrudAnidadoController');
        Log::info($rules);

        $rules = explode(';', $rules);

        $inserts = '';

        foreach ($rules as $rule) {
            if ($rule) {
                $items = explode(',', $rule);
                $operator_field = $items[0];
                $operator_value = $items[2];
                $crud_asociado_id = $items[3];
                $crud_cantidad_registros = $items[4];

                $crud = Crud::find($crud_asociado_id);

                if ($crud) {

                    $inserts .= '
                   $fieldsAnidado = [];
                    $crudAnidado = "' . $crud->nombre_componente . '";

                    foreach ($request as $key => $value) {
                    if (str_contains($key,  $crudAnidado)) {
                        $field_part = explode("_", $key);
                        $iteration = $field_part[1];
                        $fieldname = $field_part[2];
                        $fieldsAnidado[$iteration][$fieldname] = $value;
                    }
                    }

                    foreach ($fieldsAnidado as $fieldAnidado) {
                    $insertRegister = false;
                    foreach ($fieldAnidado as $keyIndividual => $fieldIndividual) {
                        if ($fieldIndividual) {
                        $insertRegister = true;
                        }
                    }

                    if ($insertRegister) {
                        $fieldAnidado["idproyecto"] = $request["idproyecto"];
                        \App\Models\UsuariosEstatus60::create($fieldAnidado);
                    }
                    }
                   ';
                }
            }
        }

        return $inserts;
    }

    public function generateCrudViews($data)
    {
        Log::info('GeneradorCrudService - generateCrudViews');

        //create dir views
        if (!is_dir("../resources/views/cruds")) {
            mkdir("../resources/views/cruds");
        }

        if (!is_dir("../resources/views/cruds/" . $data['crud_name'])) {
            mkdir("../resources/views/cruds/" . $data['crud_name']);
        }
        if (!is_dir("../resources/views/cruds/" . $data['crud_name'] . '/columns')) {
            mkdir("../resources/views/cruds/" . $data['crud_name'] . '/columns');
        }

        //create views
        //list -------------------------------
        $file_list_view = fopen("../resources/views/cruds/" . $data['crud_name'] . "/list.blade.php", "w") or die("Unable to open file - view list.blade.php");
        $template_list_view = file_get_contents('../app/Crud/template_view_list.php');
        $template_list_view = $this->generateCrudReplace($template_list_view, $data);

        fwrite($file_list_view, $template_list_view);
        fclose($file_list_view);

        //list filters -------------------------------
        $file_list_filters = fopen("../resources/views/cruds/" . $data['crud_name'] . "/filters.blade.php", "w") or die("Unable to open file - view filters.blade.php");
        $template_list_filters = file_get_contents('../app/Crud/template_view_list_filters.php');

        $file_list_filters_script = fopen("../resources/views/cruds/" . $data['crud_name'] . "/filters_script.blade.php", "w") or die("Unable to open file - view filters_script.blade.php");
        $template_list_filters_scripts = file_get_contents('../app/Crud/template_view_list_filters_scripts.php');

        $template_list_filters_field = file_get_contents('../app/Crud/template_view_list_filters_field.php');
        $template_list_filters_field_date = file_get_contents('../app/Crud/template_view_list_filters_field_date.php');

        $template_list_filters_javascript_enter = '
        const %OBJETO_LABEL% = document.getElementById("%OBJETO_LABEL%");
        %OBJETO_LABEL%.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                redirectFiltros();
            }
        });
        ';
        $template_list_filters_javascript = '        
            urlFilter = urlFilter+ "%OBJETO_LABEL%="+%OBJETO_LABEL%.value+"&";
            ';

        $template_filters = '';
        $template_filters_javascript_enter = '';
        $template_filters_javascript = '';

        foreach ($data['table_columns'] as $column) {
            if (isset($column['select'])) {
                $list_filters = $template_list_filters_field;
                $list_filters_javascript_enter = $template_list_filters_javascript_enter;
                $list_filters_javascript = $template_list_filters_javascript;

                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id = $data['tables_fk'][$column['name']]['table_column_fk_id'];

                $list_filters = str_replace('%OBJETO_LABEL_INDIVIDUAL%', $model_name, $list_filters);
                $list_filters = str_replace('%OBJETO_LABEL%', $model_name, $list_filters);
                $list_filters = str_replace('%FIELD_ID%', $column_id, $list_filters);
                $list_filters = str_replace('%FIELD_NAME%', $column_name, $list_filters);

                $template_filters .= $list_filters;

                //-------
                $list_filters_javascript_enter = str_replace('%OBJETO_LABEL%', $model_name, $list_filters_javascript_enter);
                $list_filters_javascript = str_replace('%OBJETO_LABEL%', $model_name, $list_filters_javascript);

                $template_filters_javascript_enter .= $list_filters_javascript_enter;
                $template_filters_javascript .= $list_filters_javascript;
            }

            if (in_array($column['type_html'], ['date', 'datetime-local'])) {
                $list_filters_date = $template_list_filters_field_date;
                $list_filters_javascript_enter_from = $template_list_filters_javascript_enter;
                $list_filters_javascript_enter_to = $template_list_filters_javascript_enter;
                $list_filters_javascript_from = $template_list_filters_javascript;
                $list_filters_javascript_to = $template_list_filters_javascript;

                $alias = $column['name'];
                if (isset($column['alias'])) {
                    $alias = $column['alias'];
                }
                $list_filters_date = str_replace('%FIELD%', $column['name'], $list_filters_date);
                $list_filters_date = str_replace('%FIELD_ALIAS%', $alias, $list_filters_date);

                $template_filters .= $list_filters_date;

                //-------
                $date_from = $column['name'] . '_from';
                $list_filters_javascript_enter_from = str_replace('%OBJETO_LABEL%', $date_from, $list_filters_javascript_enter_from);
                $template_filters_javascript_enter .= $list_filters_javascript_enter_from;
                $list_filters_javascript_from = str_replace('%OBJETO_LABEL%', $date_from, $list_filters_javascript_from);
                $template_filters_javascript .= $list_filters_javascript_from;


                $date_to = $column['name'] . '_to';
                $list_filters_javascript_enter_to = str_replace('%OBJETO_LABEL%', $date_to, $list_filters_javascript_enter_to);
                $template_filters_javascript_enter .= $list_filters_javascript_enter_to;
                $list_filters_javascript_to = str_replace('%OBJETO_LABEL%', $date_to, $list_filters_javascript_to);
                $template_filters_javascript .= $list_filters_javascript_to;
            }
        }

        $template_list_filters = str_replace('%VIEW_LIST_FILTROS%', $template_filters, $template_list_filters);
        $template_list_filters = $this->generateCrudReplace($template_list_filters, $data);

        fwrite($file_list_filters, $template_list_filters);
        fclose($file_list_filters);

        $template_list_filters_scripts = str_replace('%VIEW_LIST_FILTROS_JAVASCRIPT_ENTER%', $template_filters_javascript_enter, $template_list_filters_scripts);
        $template_list_filters_scripts = str_replace('%VIEW_LIST_FILTROS_JAVASCRIPT%', $template_filters_javascript, $template_list_filters_scripts);
        $template_list_filters_scripts = $this->generateCrudReplace($template_list_filters_scripts, $data);

        fwrite($file_list_filters_script, $template_list_filters_scripts);
        fclose($file_list_filters_script);

        //show-------------------
        $file_show_view = fopen("../resources/views/cruds/" . $data['crud_name'] . "/show.blade.php", "w") or die("Unable to open file - view show.blade.php");
        $template_list_show = file_get_contents('../app/Crud/template_view_show.php');
        $template_list_show = $this->generateCrudReplace($template_list_show, $data);

        fwrite($file_show_view, $template_list_show);
        fclose($file_show_view);

        //create-------------------
        $file_create = fopen("../resources/views/cruds/" . $data['crud_name'] . "/create.blade.php", "w") or die("Unable to open file - view create.blade.php");
        $template_create = file_get_contents('../app/Crud/template_view_create.php');
        $template_create = $this->generateCrudReplace($template_create, $data);

        fwrite($file_create, $template_create);
        fclose($file_create);

        //edit-------------------
        $file_edit = fopen("../resources/views/cruds/" . $data['crud_name'] . "/edit.blade.php", "w") or die("Unable to open file - view edit.blade.php");
        $template_edit = file_get_contents('../app/Crud/template_view_edit.php');
        $template_edit = $this->generateCrudReplace($template_edit, $data);

        fwrite($file_edit, $template_edit);
        fclose($file_edit);

        //datatable-------------------
        $file_datatable_view = fopen("../resources/views/cruds/" . $data['crud_name'] . "/datatable.blade.php", "w") or die("Unable to open file - view dattable.blade.php");
        $template_datatable = file_get_contents('../app/Crud/template_view_datatable.php');
        $template_datatable = $this->generateCrudReplace($template_datatable, $data);

        fwrite($file_datatable_view, $template_datatable);
        fclose($file_datatable_view);

        // field------------------
        $file_fields = fopen("../resources/views/cruds/" . $data['crud_name'] . "/fields.blade.php", "w") or die("Unable to open file - view fields.blade.php");
        $template_fields = file_get_contents('../app/Crud/template_view_field.php');
        $template_fields_select = file_get_contents('../app/Crud/template_view_field_select.php');
        $template_fields_select_anidado = file_get_contents('../app/Crud/template_view_field_select_campo_anidado.php');
        $template_fields_html = file_get_contents('../app/Crud/template_view_field_html.php');

        $fields_all = '<input type="hidden" name="redirect_url" id="redirect_url" value="{{ (request()->has("redirect_url")) ? request()->get("redirect_url") : "" }}">';
        $action_documento = '';

        $table_columns = $data['table_columns'];

        usort($table_columns, function ($a, $b) {
            return $a['indice'] <=> $b['indice'];
        });
        foreach ($table_columns as $column) {
            $template = '';

            $show_column_name = $column['name'];
            $show_column_name_alias = $column['name'];
            $column_readonly = '';
            $column_required = '';
            $column_required_icon = '';
            $column_regex = '';
            $column_maxlength = '';
            $column_text_help = "";
            $column_anidado = "";

            if (isset($column['alias'])) {
                $show_column_name_alias = $column['alias'];
            }
            if (isset($column['help'])) {
                $column_text_help = '<p class="text-muted">' . $column['help'] . '</p>';
            }
            if (isset($column['readonly']) && $column['readonly']) {
                $column_readonly = "readonly";
            }
            if (isset($column['required']) && $column['required']) {
                $column_required = "required";
                $column_required_icon = '<label class="text-danger">*</label>';
            }

            $value = '';

            if (isset($column['select'])) {
                $template = $template_fields_select;
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id = $data['tables_fk'][$column['name']]['table_column_fk_id'];
                $column_idproyecto_fk = $data['tables_fk'][$column['name']]['table_column_fk_idproyecto'];
                $column_idcliente_fk = $data['tables_fk'][$column['name']]['table_column_fk_idcliente'];

                $campo_anidado = '';
                $campo_anidado_option = '';
                $crud_anidado = '';

                if (isset($column['anidado']) && $column['anidado']) {
                    $template_select_anidado = $template_fields_select_anidado;
                    $template_select_anidado = str_replace('%SELECT_CAMPO_ANIDADO%', $column['anidado'], $template_select_anidado);
                    $template_select_anidado = str_replace('%SELECT_NAME%', $column['name'], $template_select_anidado);

                    $campo_anidado = $template_select_anidado;

                    $campo_anidado_option = $column['anidado'] . '={{ $item->' . $column['anidado'] . ' }}';
                }

                $options = '
                    @foreach($' . $model_name . ' as $item)
                    <option value="{{ $item->' . $column_id . ' }}" class="" ' . $campo_anidado_option . ' {{ (isset($' . $data['crud_name'] . ') && $item->' . $column_id . ' == $' . $data['crud_name'] . '->' . $show_column_name . ')?"selected":"" }} {{ (session()->has("' . $column_id . '") && $item->' . $column_id . ' == session()->get("' . $column_id . '")) ? "selected" : "" }} {{ (request()->has("' . $column_id . '") && $item->' . $column_id . ' == request()->get("' . $column_id . '")) ? "selected" : "" }} >
                    {{ $item->' . $column_name . ' }}
                    </option>
                    @endforeach';

                if (isset($column['readonly']) && $column['readonly']) {
                    $column_readonly = '{!! !in_array("create",request()->segments())?"aria-readonly=\'true\' style=\'pointer-events: none;\'":"" !!}';
                }

                $template = str_replace('%FIELD_SELECT_OPTIONS%', $options, $template);
                $template = str_replace('%FIELD_SELECT_CAMPO_ANIDADO%', $campo_anidado, $template);

                if (isset($column['crud_anidado_rules']) && $column['crud_anidado_rules']) {
                    $crud_anidado = $this->getCrudAnidado($column['crud_anidado_rules']);
                }

                $template = str_replace('%FIELD_SELECT_CRUD_ANIDADO%', $crud_anidado, $template);
            } elseif ($column['type_html'] == 'html') {
                $template = $template_fields_html;

                $value = '( isset($' . $data['crud_name'] . ')?$' . $data['crud_name'] . '->' . $column['name'] . ':"")';
                $template = str_replace('%FIELD_VALUE_SHOW%', $value, $template);
                $template = str_replace('%FIELD_ID%', $data['table_column_id'], $template);
                $template = str_replace('%OBJETO%', $data['crud_name'], $template);

                /* 
                $action_documento = '
                <!--begin::Menu item-->
                <div class="menu-item px-3">
                    <a href="{{ url("/docs/' . $data['crud_name'] . '_". $' . $data['crud_name'] . '->' . $data['table_column_id'] . '.".pdf" ) }}" class="menu-link px-3" target="_blank">
                        Pdf
                    </a>
                </div>
                <!--end::Menu item-->
                '; 
                */
            } else {
                if (isset($column['regex']) && $column['regex']) {
                    Log::info('$column["regex"]');
                    Log::info($column['regex']);
                    $regexDecode = urldecode($column['regex']);
                    Log::info('$regexDecode');
                    Log::info($regexDecode);
                    $column_regex = ' pattern="' . $regexDecode . '" ';
                }

                if (isset($column['maxlength']) && $column['maxlength']) {
                    $column_maxlength = 'maxlength="' . $column['maxlength'] . '"';
                }

                $template = $template_fields;

                if ($data['table_column_id'] == $column['name']) {
                    $template = '';
                }

                $template = str_replace('%FIELD_TYPE%', $column['type_html'], $template);

                $value = '( isset($' . $data['crud_name'] . ')?$' . $data['crud_name'] . '->' . $column['name'] . ':"")';
                $value_file = '';

                $field_style = "form-control form-control-solid";
                $field_checked = '';

                if ($column['type_html'] == 'checkbox') {
                    $value = '(isset($' . $data['crud_name'] . ') && $' . $data['crud_name'] . '->' . $column['name'] . '?"ON":"OFF")';
                    $field_style = "form-check-input";
                    $field_checked = '{{ (isset($' . $data['crud_name'] . ') && $' . $data['crud_name'] . '->' . $column['name'] . '?"checked":"") }}';
                }
                if ($column['type_html'] == 'password') {
                    $value = '"---"';
                }
                if ($column['type_html'] == 'file') {
                    $value_file = '
                    @if( isset($' . $data['crud_name'] . ') && $' . $data['crud_name'] . '->' . $column['name'] . ' )
                    <br>
                    <a href="/images/{{ $' . $data['crud_name'] . '->' . $column['name'] . ' }}" target="_blank">
                    <img src="/images/{{ $auxiliarService->getImageFile($' . $data['crud_name'] . '->' . $column['name'] . ') }}" style="width:250px;">
                    </a>
                    @endif
                    ';

                    $show_column_name = $show_column_name . '_file';
                }

                $template = str_replace('%FIELD_VALUE_SHOW%', $value, $template);
                $template = str_replace('%FIELD_FILE%', $value_file, $template);

                $template = str_replace('%FIELD_STYLE%', $field_style, $template);
                $template = str_replace('%FIELD_CHECKED%', $field_checked, $template);
                $template = str_replace('%FIELD_PATTERN%', $column_regex, $template);
                $template = str_replace('%FIELD_MAXLENGTH%', $column_maxlength, $template);
            }

            $template = str_replace('%FIELD_READONLY%', $column_readonly, $template);
            $template = str_replace('%FIELD_REQUIRED%', $column_required, $template);
            $template = str_replace('%FIELD_REQUIRED_ICON%', $column_required_icon, $template);
            $template = str_replace('%FIELD%', $show_column_name, $template);
            $template = str_replace('%FIELD_ALIAS%', $show_column_name_alias, $template);
            $template = str_replace('%FIELD_TEXT_HELP%', $column_text_help, $template);

            $fields_all .= $template;
        }

        $fields_all = $this->generateCrudReplace($fields_all, $data);

        fwrite($file_fields, $fields_all);
        fclose($file_fields);

        //actions ----------------------
        $file_action_view = fopen("../resources/views/cruds/" . $data['crud_name'] . "/columns/_actions.blade.php", "w") or die("Unable to open file - view actions.blade.php");
        $template_list_actions = file_get_contents('../app/Crud/template_view_actions.php');
        $template_list_actions = $this->generateCrudReplace($template_list_actions, $data);
        $template_list_actions = str_replace('%ACTION_DOCUMENTO%', $action_documento, $template_list_actions);


        fwrite($file_action_view, $template_list_actions);
        fclose($file_action_view);

        //draw scripts -------------------
        $file_draw_scripts_view = fopen("../resources/views/cruds/" . $data['crud_name'] . "/columns/_draw-scripts.js", "w") or die("Unable to open file - view _draw-scripts.js");
        $template_list_draw_js = file_get_contents('../app/Crud/template_view_draw_js.php');
        $template_list_draw_js = $this->generateCrudReplace($template_list_draw_js, $data);

        fwrite($file_draw_scripts_view, $template_list_draw_js);
        fclose($file_draw_scripts_view);

        //view table---------------------------------
        $file_table = fopen("../resources/views/cruds/" . $data['crud_name'] . "/columns/_table.blade.php", "w") or die("Unable to open file - view table.blade.php");

        $template_table = file_get_contents('../app/Crud/template_view_table.php');
        $template_table = $this->generateCrudReplace($template_table, $data);
        $template_table_all = '';

        foreach ($data['table_columns'] as $column) {
            $template_table_replace = $template_table;
            $template_table_replace = str_replace('%FIELD%', $column['name'], $template_table_replace);
            $template_table_all .=  $template_table_replace;
        }

        fwrite($file_table, $template_table_all);
        fclose($file_table);
    }

    public function generateCrudDatatable($data)
    {
        Log::info('GeneradorCrudService - generateCrudDatatable');

        //create datatable
        $file = fopen("../app/DataTables/" . $data['datatable_name'] . ".php", "w") or die("Unable to open file - datatable " . $data['datatable_name']);

        //fields
        $template_fields = file_get_contents('../app/Crud/template_datatable_datatable.php');
        $template_fields = $this->generateCrudReplace($template_fields, $data);
        $template_fields_all = '';
        $incluir_list = false;
        $template_fields_list = '';

        Log::info('generateCrudDatatable---------');

        $table_columns = $data['table_columns'];

        usort($table_columns, function ($a, $b) {
            return $a['indice'] <=> $b['indice'];
        });

        foreach ($table_columns as $column) {
            $datatable_column_name = $column['name'];
            if (isset($column['alias']) && $column['name'] != $data['table_column_id']) {
                $datatable_column_name = $column['alias'];
            }
            if (isset($column['select'])) {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $datatable_column_name, $template_fields_replace);
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $return = 'return $%OBJETO_VARIABLE%->' . $model_name . '->first()?->' . $column_name . ';'; //ucwords($user->roles->first()?->name);

            } else {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $datatable_column_name, $template_fields_replace);

                if ($column['type_html'] == 'checkbox') {
                    $return = 'return ($%OBJETO_VARIABLE%->' . $column['name'] . '?"ON":"OFF");';
                } else if ($column['type_html'] == 'password') {
                    $return = 'return "---";';
                } else if ($column['type_html'] == 'file') {
                    $return = 'return ($' . $data['model_name'] . '->' . $column['name'] . ' ?(new HtmlString(\'
                    <a href="/images/' . '\'.$' . $data['model_name'] . '->' . $column['name'] . '.\'" target="_blank">
                    <img src="/images/' . '\'.$auxiliarService->getImageFile($' . $data['model_name'] . '->' . $column['name'] . ').\'"  title="\'.$' . $data['model_name'] . '->' . $column['name'] . '.\'" alt="\'.$' . $data['model_name'] . '->' . $column['name'] . '.\'" border="0" width="40" class="img-rounded" />
                    </a>
                    \') ):"");';
                } else {
                    $return = 'return mb_convert_encoding( $%OBJETO_VARIABLE%->' . $column['name'] . ', "UTF-8", "UTF-8");';
                }
            }

            $template_fields_replace = str_replace('%DATATABLE_RETURN%', $return, $template_fields_replace);
            $template_fields_replace = $this->generateCrudReplace($template_fields_replace, $data);
            $template_fields_all .=  $template_fields_replace;

            if (isset($column['incluir_list'])) {
                $incluir_list = true;
                $template_fields_list .=  $template_fields_replace;
            }
        }

        if ($incluir_list) {
            $template_fields_all = $template_fields_list;
        }

        //columns - queries
        $template_columns = file_get_contents('../app/Crud/template_datatable_getcolumns.php');
        $template_columns = $this->generateCrudReplace($template_columns, $data);
        $template_columns_all = '';
        $incluir_list = false;
        $template_columns_list = '';

        $template_datatable_queries = file_get_contents('../app/Crud/template_datatable_queries.php');
        $template_datatable_queries_all = '';
        $datatables_fields_query = env('DATATABLES_FIELDS_QUERY', 'idcliente,idproyecto,idrol');
        $datatables_queries = explode(',', $datatables_fields_query);

        $filters_rules = '';

        if (isset($data['rules']) && $data['rules']) {
            $rules_array = explode(';', $data['rules']);
            foreach ($rules_array as $rule) {
                $rule_array = explode(',', $rule);
                $filters_rules .= '
                $query->where("' . $rule_array[0] . '", "' . $rule_array[1] . '","' . $rule_array[2] . '");
                ';
            }
        }

        $filters = '';
        $template_filters = '
        if ($this->filters && isset($this->filters["%OBJETO_LABEL%"])) {
            $query->where("%FIELD_ID%", $this->filters["%OBJETO_LABEL%"]);
        }
        ';

        $template_filters_min = '
        if ($this->filters && isset($this->filters["%OBJETO_LABEL%"])) {
            $query->where("%FIELD_ID%", ">",  $this->filters["%OBJETO_LABEL%"]);
        }
        ';

        $template_filters_max = '
        if ($this->filters && isset($this->filters["%OBJETO_LABEL%"])) {
            $query->where("%FIELD_ID%", "<",  $this->filters["%OBJETO_LABEL%"]);
        }
        ';

        $template_filters_texto = $data['table_column_id'] . ",' ',";

        foreach ($table_columns as $column) {
            $datatable_column_field_name = $column['name'];
            if (isset($column['alias']) && $column['name'] != $data['table_column_id']) {
                $datatable_column_field_name = $column['alias'];
            }

            $template_columns_replace = $template_columns;
            $template_columns_replace = str_replace('%FIELD%', $datatable_column_field_name, $template_columns_replace);
            $template_columns_all .=  $template_columns_replace;

            if (isset($column['incluir_list'])) {
                $incluir_list = true;
                $template_columns_list .=  $template_columns_replace;
            }

            if (in_array($column['name'], $datatables_queries)) {
                $template_queries_replace = $template_datatable_queries;
                $template_queries_replace = str_replace('%FIELD%', $column['name'], $template_queries_replace);
                $template_datatable_queries_all .=  $template_queries_replace;
            }

            if ($column['name'] == 'idusuario') {
                $template_queries_replace = $template_datatable_queries;
                $template_queries_replace = str_replace('%FIELD%', $column['name'], $template_queries_replace);
                $template_datatable_queries_all .=  $template_queries_replace;
            }

            if (isset($column['select'])) {
                $list_filters = $template_filters;

                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id = $data['tables_fk'][$column['name']]['table_column_fk_id'];

                $list_filters = str_replace('%OBJETO_LABEL%', $model_name, $list_filters);

                // if (in_array($model_name, ['Users', 'users'])) {
                //     $list_filters = str_replace('%FIELD_ID%', 'idusuario', $list_filters);
                // } else {
                $list_filters = str_replace('%FIELD_ID%', $column['name'], $list_filters);
                // }

                $filters .= $list_filters;


                $list_filters = $template_filters;
                $list_filters = str_replace('%OBJETO_LABEL%', $column['name'], $list_filters);
                $list_filters = str_replace('%FIELD_ID%', $column['name'], $list_filters);

                $filters .= $list_filters;
            }

            if (in_array($column['type_html'], ['date', 'datetime-local'])) {
                $list_filters_from = $template_filters_min;
                $date_name = $column['name'];
                $date_from = $column['name'] . '_from';
                $date_to = $column['name'] . '_to';

                $list_filters_from = str_replace('%OBJETO_LABEL%', $date_from, $list_filters_from);
                $list_filters_from = str_replace('%FIELD_ID%', $date_name, $list_filters_from);

                $filters .= $list_filters_from;

                $list_filters_to = $template_filters_max;

                $list_filters_to = str_replace('%OBJETO_LABEL%', $date_to, $list_filters_to);
                $list_filters_to = str_replace('%FIELD_ID%', $date_name, $list_filters_to);

                $filters .= $list_filters_to;
            }

            if ($column['type_html'] == 'text') {
                $template_filters_texto .= $column['name'] . ",' ',";
            }
        }

        if ($incluir_list) {
            $template_columns_all = $template_columns_list;
        }

        $template = file_get_contents('../app/Crud/template_datatable.php');
        $template = $this->generateCrudReplace($template, $data);

        $template = str_replace('%FIELDS_DATATABLES_DATATABLE%', $template_fields_all, $template);
        $template = str_replace('%FIELDS_DATATABLES_GETCOLUMNS%', $template_columns_all, $template);
        $template = str_replace('%DATATABLE_QUERY_FILTERS_RULES%', $filters_rules, $template);
        $template = str_replace('%DATATABLE_QUERY_FILTERS%', $template_datatable_queries_all, $template);
        $template = str_replace('%DATATABLE_QUERY_FILTERS_DYNAMIC%', $filters, $template);
        $template_filters_texto = substr($template_filters_texto, 0, -1);
        $template = str_replace('%DATATABLE_QUERY_FILTERS_DYNAMIC_TEXTO%', $template_filters_texto, $template);

        fwrite($file, $template);
        fclose($file);
    }


    public function generateCrudLivewire($data)
    {
        Log::info('GeneradorCrudService - generateCrudLivewire');

        //create livewire

        //create dir 
        if (!is_dir("../app/Livewire/" . $data['model_name'])) {
            mkdir("../app/Livewire/" . $data['model_name']);
        }

        $file = fopen("../app/Livewire/" . $data['model_name'] . "/Add" . $data['model_name'] . "Modal.php", "w") or die("Unable to open file - Livewire " . $data['model_name']);
        $template = file_get_contents('../app/Crud/template_livewire.php');

        $columns = '';
        $datasSubmit = '';
        $datasUpdate = '';
        $crud_name = $data['crud_name'];

        $livewire_select = '';
        $livewire_select_use = '';

        foreach ($data['table_columns'] as $column) {
            $column_name = $column['name'];
            $column_type_html = $column['type_html'];

            if ($column['type_html'] == 'checkbox') {
                $columnConst = '
                public bool $' . $column['name'] . ';
                ';
            } else {
                $columnConst = '
                public $' . $column['name'] . ';
                ';
            }

            $columns .= $columnConst;

            $data1 = ' $data [ "';
            $data3 = '" ] = $this->';
            $data5 = ';  ';

            $dataSubmit = '';
            if ($column_name != $data['table_column_id']) {
                $dataSubmit = ' 
            if(  isset( $this->' . $column_name . ') ){
            $data [ "' . $column_name . '" ] = $this->' . $column_name . ';  
            }';
            }
            /*if ($column_type_html == 'checkbox') {
                $dataSubmit .= ' 
                else{
                $data [ "' . $column_name . '" ] = 0;  
                }';
            }*/

            $datasSubmit .= $dataSubmit;


            $dataUpdate = '
            $this->' . $column_name . ' = $' . $crud_name . '->' . $column_name . ';
            ';
            $datasUpdate .= $dataUpdate;
            //--------
            if (isset($column['select'])) {
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id = $data['tables_fk'][$column['name']]['table_column_fk_id'];

                $use = '
                use App\Models\\' . $model_name . ';';
                //Log::info($use);
                $livewire_select_use .= $use;

                $param = '
                "' . $model_name . '" => ' . $model_name . '::all(),
                ';
                //Log::info($param);
                $livewire_select .= $param;
            }
        }

        $template = str_replace('%LIVEWIRE_COLUMNS%', $columns, $template);
        $template = str_replace('%LIVEWIRE_RULES%', '', $template);
        $template = str_replace('%LIVEWIRE_DATA%', $datasSubmit, $template);
        $template = str_replace('%LIVEWIRE_FIELDS%', $datasUpdate, $template);
        $template = str_replace('%LIVEWIRE_SELECTS%', $livewire_select, $template);
        $template = str_replace('%LIVEWIRE_SELECTS_USE%', $livewire_select_use, $template);

        $template = $this->generateCrudReplace($template, $data);

        fwrite($file, $template);
        fclose($file);

        //create views
        if (!is_dir("../resources/views/livewire/" . $data['crud_name'])) {
            mkdir("../resources/views/livewire/" . $data['crud_name']);
        }

        $file_list = fopen("../resources/views/livewire/" . $data['crud_name'] . "/list.blade.php", "w") or die("Unable to open file - view list.blade.php");
        $template_list = file_get_contents('../app/Crud/template_livewire_view_list.php');
        $template_list = $this->generateCrudReplace($template_list, $data);

        fwrite($file_list, $template_list);
        fclose($file_list);

        //Modal
        $file_modal = fopen("../resources/views/livewire/" . $data['crud_name'] . "/add-" . $data['crud_name'] . "-modal.blade.php", "w") or die("Unable to open file - view add-modal.blade.php");
        $template_modal = file_get_contents('../app/Crud/template_livewire_view_modal.php');
        $template_modal = $this->generateCrudReplace($template_modal, $data);

        fwrite($file_modal, $template_modal);
        fclose($file_modal);


        $file_fields = fopen("../resources/views/livewire/" . $data['crud_name'] . "/fields.blade.php", "w") or die("Unable to open file - view fields.blade.php");
        $template_fields = file_get_contents('../app/Crud/template_livewire_view_modal_fields.php');

        $template_modal_fields = '<div class="row">';
        foreach ($data['table_columns'] as $column) {
            $column_name = $column['name'];
            $livewire_column_name = $column['name'];
            if (isset($column['alias'])) {
                $livewire_column_name = $column['alias'];
            }
            $column_type_html = $column['type_html'];

            if ($column_name != $data['table_column_id']) {
                $template = $template_fields;
                $template = str_replace('%FIELD%', $livewire_column_name, $template);

                $class = 'form-control form-control-solid mb-3 mb-lg-0';


                if (isset($column['select'])) {
                    $model_name_fk = $data['tables_fk'][$column['name']]['table_name_fk'];
                    $column_name_fk = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                    $column_id_fk = $data['tables_fk'][$column['name']]['table_column_fk_id'];

                    $class = 'form-select mb-3 mb-lg-0';

                    $input = '
                    <select wire:model="' . $column_name . '" name="' . $column_name . '" class="' . $class . '" placeholder="' . $column_name . '" />
                    <option value="">-</option>
                    @foreach($' . $model_name_fk . ' as $item)
                    <option value="{{ $item->' . $column_id_fk . ' }}">{{ $item->' . $column_name_fk . '}}</option>
                    @endforeach
                    </select>
                    ';
                } else {
                    $input = '';

                    if ($column_type_html == 'checkbox') {
                        $class = 'form-check-input mb-3 mb-lg-0';
                    }
                    if ($column_type_html == 'file') {
                        $input .= '
                        @if( isset($' . $column['name'] . ') && $' . $column['name'] . ' )
                        <br><img src="/images/{{ $' . $column['name'] . ' }}" style="width:100px;">
                        @endif
                        ';
                    }

                    $input .= '<input type="' . $column_type_html . '" wire:model="' . $column_name . '" name="' . $column_name . '" class="' . $class . '" placeholder="' . $column_name . '" />';
                }

                $template = str_replace('%INPUT_FIELD%', $input, $template);
                $template_modal_fields .= $template;
            }
        }
        $template_modal_fields .= '</div>';

        fwrite($file_fields, $template_modal_fields);
        fclose($file_fields);
    }


    public function generateCrudRelations($data)
    {
        Log::info('GeneradorCrudService - generateCrudRelations ----');

        $template_show_datatable = file_get_contents('../app/Crud/template_view_show_datatable.php');
        $crudName = $data['crud_name'];
        $tableNameLabel = $data['table_name_label'];
        $tableNameLabelAlias = $data['table_name_label_alias'];
        $tableNameDatatable = $data['crud_name'] . 'DataTable';
        $tableVariableDatatable = 'datatable' . $data['crud_name'];

        foreach ($data['tables_crud_relation_fk'] as $keyCrud => $crud_relation) {
            $crud = Crud::find($crud_relation['crud']);
            $permisos = (isset($crud_relation['permisos']) ? $crud_relation['permisos'] : null);
            Log::info($keyCrud);
            Log::info($crud_relation);

            if ($permisos) {
                $permisos = explode(',', $permisos);
            }

            if ($crud) {
                //controller---
                $controllerName = $crud->nombre_componente . 'Controller';
                $datatableName = $crud->nombre_componente . 'DataTable';
                $componentName = $crud->nombre_componente;
                $viewShowName = 'show';

                $template_controller = file_get_contents('../app/Http/Controllers/Crud/' . $controllerName . '.php');
                //$search_datatable = 'use App\DataTables\\' . $tableNameDatatable . ';';
                $create = false;

                if (!str_contains($template_controller, $tableNameDatatable)) {
                    $relation_variables_data_use = '
                    use App\DataTables\\' . $tableNameDatatable . ';
                    //%RELATION_DATATABLE_VARIABLES_USE%
                    ';

                    $template_controller = str_replace("//%RELATION_DATATABLE_VARIABLES_USE%", $relation_variables_data_use, $template_controller);
                }

                $relation_variables = '
                    $filters' . $crudName . ' = [];
                    $filters' . $crudName . ' = ["rutaDatatable" => true];
                    ';

                foreach ($permisos as $key => $permiso) {
                    if ($permiso == 'read') {
                        $relation_variables .= '
                            $filters' . $crudName . ' ["datatable"] ["read"] = true;
                            ';
                    }
                    if ($permiso == 'update') {
                        $relation_variables .= '
                            $filters' . $crudName . ' ["datatable"] ["update"] = true;
                            ';
                    }
                    if ($permiso == 'delete') {
                        $relation_variables .= '
                            $filters' . $crudName . ' ["datatable"] ["delete"] = true;
                            ';
                    }
                    if ($permiso == 'create') {
                        $create = true;
                    }
                }

                $relation_variables .= '
                            $filters' . $crudName . ' ["datatableFilters"] = ["' . $keyCrud . '" => $idRegister];
                            ';

                $relation_variables .= '
                    $dataTable' . $crudName . ' = new ' . $tableNameDatatable . '($filters' . $crudName . ');
                    
                    //%RELATION_DATATABLE_VARIABLES%
                    ';

                $template_controller = str_replace("//%RELATION_DATATABLE_VARIABLES%", $relation_variables, $template_controller);

                $search = '$dataTable' . $crudName . '->html()';
                if (!str_contains($template_controller, $search)) {

                    $relation_variables_data = '
                    "dataTable' . $crudName . '" => $dataTable' . $crudName . '->html(),

                    //%RELATION_DATATABLE_VARIABLES_DATA%
                    ';

                    $template_controller = str_replace("//%RELATION_DATATABLE_VARIABLES_DATA%", $relation_variables_data, $template_controller);
                }

                $file_controller = fopen("../app/Http/Controllers/Crud/" . $controllerName . ".php", "w") or die("Unable to open file - controller " . $controllerName);
                fwrite($file_controller, $template_controller);
                fclose($file_controller);

                //show
                $template_datatable =  $template_show_datatable;
                $template_datatable = str_replace("%OBJETO%", $crudName, $template_datatable);
                $template_datatable = str_replace("%OBJETO_ALIAS%", $tableNameLabelAlias, $template_datatable);
                $template_datatable = str_replace("%OBJETO_DATATABLE%", $tableNameDatatable, $template_datatable);

                if ($create) {
                    $link = '
                    <a href="{{ route("' . $tableNameDatatable . '.create") }}?' . $keyCrud . '={{ $' . $componentName . '->' . $keyCrud . ' }}&&redirect_url={{ url()->current() }}" class="btn btn-primary float-end"> 
                    Agregar
                    </a> ';
                    $template_datatable = str_replace("%ACCORDION_CREATE%", $link, $template_datatable);
                } else {
                    $template_datatable = str_replace("%ACCORDION_CREATE%", '', $template_datatable);
                }

                $file_datatable_show = fopen('../resources/views/cruds/' . $componentName . '/datatable_' . $crudName . '.blade.php', "w") or die("Unable to open file - view datatable_'.$crudName.'.blade.php");
                fwrite($file_datatable_show, $template_datatable);
                fclose($file_datatable_show);

                $template_show = file_get_contents('../resources/views/cruds/' . $componentName . '/show.blade.php');
                $search = 'datatable_' . $crudName;

                if (!str_contains($template_show, $search)) {
                    $template_datatable = '
                    @include("cruds.' . $componentName . '.datatable_' . $crudName . '")
    
                    <!-- %RELATIONS_DATATABLE% -->
                    ';

                    $template_show = str_replace("<!-- %RELATIONS_DATATABLE% -->", $template_datatable, $template_show);

                    $template_datatable_script = '                  
                    {{$dataTable' . $crudName . '->scripts()}}

                    <!-- %RELATIONS_DATATABLE_SCRIPTS% -->
                    ';

                    $template_show = str_replace("<!-- %RELATIONS_DATATABLE_SCRIPTS% -->", $template_datatable_script, $template_show);

                    $file_show = fopen('../resources/views/cruds/' . $componentName . '/show.blade.php', "w") or die("Unable to open file - view show.blade.php");
                    fwrite($file_show, $template_show);
                    fclose($file_show);
                }
            }
        }
    }

    public function generateCrudMenu($data)
    {
        $menu = file_get_contents('../resources/views/layout/partials/sidebar-layout/sidebar/_menu-item-crud.blade.php');
        $search = $this->generateCrudReplace('crud.%OBJETO_VIEW%.*', $data);

        if (!str_contains($menu, $search)) {

            //create menu
            $template_menu = file_get_contents('../app/Crud/template_menu.php');
            $template_menu = $this->generateCrudReplace($template_menu, $data);

            $template = file_put_contents('../resources/views/layout/partials/sidebar-layout/sidebar/_menu-item-crud.blade.php', $template_menu . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }




    public function generateCrudBreadcrumb($data)
    {
        $route = file_get_contents('../routes/breadcrumbs.php');
        $search = $this->generateCrudReplace('crud.%OBJETO_ROUTE%.index', $data);

        if (!str_contains($route, $search)) {

            //create 
            $template_breadcrumb = file_get_contents('../app/Crud/template_breadcrumb.php');
            $template_breadcrumb = $this->generateCrudReplace($template_breadcrumb, $data);

            $template = file_put_contents('../routes/breadcrumbs.php', $template_breadcrumb . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    public function generateCrudRoute($data)
    {
        $menu = file_get_contents('../routes/web_base.php');
        $search = $this->generateCrudReplace("'/crud/%OBJETO_VIEW%'", $data);

        if (!str_contains($menu, $search)) {

            //create route

            /*
        $new_route = "
        use App\Http\Controllers\Crud\%OBJETO%Controller;
        Route::resource('/crud/%OBJETO_VIEW%', %OBJETO%Controller::class);
        ";
        */

            $item_nombre  = $data['model_name'];
            $item_controller = $data['model_name'] . "Controller";
            $item_datatable = $data['model_name'] . "DataTable";

            $new_route = "
            use App\Http\Controllers\Crud\\" . $item_controller . ";
            Route::name('crud.')->group(function () {
                Route::resource('/crud/" . $item_nombre . "', " . $item_controller . "::class);
            }); 
            Route::get('crud/" . $item_datatable . "',[" . $item_controller . "::class, 'get" . $item_datatable . "'])->name('crud." . $item_datatable . "');
            Route::get('crud/" . $item_datatable . "/create',[$item_controller ::class, 'create'])->name('" . $item_datatable . ".create');
            ";

            $new_route = $this->generateCrudReplace($new_route, $data);

            $template_route = file_put_contents('../routes/web_base.php', $new_route . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    public function generateCrudReplace($content, $data)
    {
        $content = str_replace('%OBJETO%', $data['model_name'], $content);
        $content = str_replace('%OBJETO_LABEL%', $data['table_name_label'], $content);
        $content = str_replace('%OBJETO_LABEL_ALIAS%', $data['table_name_label_alias'], $content);
        $content = str_replace('%OBJETO_LABEL_INDIVIDUAL%', $data['table_name_label_individual'], $content);

        $content = str_replace('%TABLA%', $data['table_fullname'], $content);
        $content = str_replace('%TABLA_CAMPOS%', $data['table_columns_string'], $content);
        $content = str_replace('%FIELD_ID%', $data['table_column_id'], $content);

        $content = str_replace('%OBJETO_TABLE%', $data['table_fullname'], $content);
        $content = str_replace('%OBJETO_CONTROLLER%', $data['controller_name'], $content);
        $content = str_replace('%OBJETO_OBSERVER%', $data['observer_name'], $content);
        $content = str_replace('%OBJETO_SERVICE%', $data['service_name'], $content);
        $content = str_replace('%SELECT_USE%', '', $content);
        $content = str_replace('%OBJETO_VIEW%', $data['crud_name'], $content);
        $content = str_replace('%OBJETO_VARIABLE%', $data['crud_name'], $content);
        $content = str_replace('%OBJETO_DATATABLE%', $data['datatable_name'], $content);

        $content = str_replace('%OBJETO_ROUTE%', $data['crud_name'], $content);

        if (!$data['crud_permisos_create']) {
            $content = str_replace('%OBJETO_CREATE%', 'd-none', $content);
            $content = str_replace('%OBJETO_CONTROLLER_CREATE%', 'return redirect($rutaCrud)->with("message-error","Acción no disponible");', $content);
        } else {
            $content = str_replace('%OBJETO_CREATE%', '', $content);
            $content = str_replace('%OBJETO_CONTROLLER_CREATE%', '', $content);
        }
        if (!$data['crud_permisos_read']) {
            $content = str_replace('%OBJETO_READ%', 'd-none', $content);
            $content = str_replace('%OBJETO_CONTROLLER_READ%', 'return redirect($rutaCrud)->with("message-error","Acción no disponible");', $content);
        } else {
            $content = str_replace('%OBJETO_READ%', '', $content);
            $content = str_replace('%OBJETO_CONTROLLER_READ%', '', $content);
        }
        if (!$data['crud_permisos_update']) {
            $content = str_replace('%OBJETO_UPDATE%', 'd-none', $content);
            $content = str_replace('%OBJETO_CONTROLLER_UPDATE%', 'return redirect($rutaCrud)->with("message-error","Acción no disponible");', $content);
        } else {
            $content = str_replace('%OBJETO_UPDATE%', '', $content);
            $content = str_replace('%OBJETO_CONTROLLER_UPDATE%', '', $content);
        }
        if (!$data['crud_permisos_delete']) {
            $content = str_replace('%OBJETO_DELETE%', 'd-none', $content);
            $content = str_replace('%OBJETO_CONTROLLER_DELETE%', 'return redirect($rutaCrud)->with("message-error","Acción no disponible");', $content);
        } else {
            $content = str_replace('%OBJETO_DELETE%', '', $content);
            $content = str_replace('%OBJETO_CONTROLLER_DELETE%', '', $content);
        }

        if (isset($data['objeto_fk'])) {
            $content = str_replace('%OBJETO_FK%', $data['objeto_fk'], $content);
        }

        if (isset($data['tabla_fk'])) {
            $content = str_replace('%TABLA_FK%', $data['tabla_fk'], $content);
        }

        if (isset($data['tabla_campos_fk'])) {
            $content = str_replace('%TABLA_CAMPOS_FK%', $data['tabla_campos_fk'], $content);
        }

        if (isset($data['tabla_id_fk'])) {
            $content = str_replace('%FIELD_ID_FK%', $data['tabla_id_fk'], $content);
        }

        return $content;
    }

    public function limpiarCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        //artisan optimize:clear
        Artisan::call('optimize:clear');
    }

    public function crudRefresh($crud_id)
    {
        $result = $this->crudRefreshProcess($crud_id);

        if ($result) {
            $accordions = [];
            $cruds = Crud::where('estatus', 1)->get();

            foreach ($cruds as $crud_generado) {
                $campos_array = json_decode($crud_generado->campos);
                if ($campos_array) {
                    foreach ($campos_array as $campo) {
                        if ($campo->show_fk && $campo->show_fk == $crud_id) {
                            $accordions[] = $crud_generado->id;
                        }
                    }
                }
            }

            foreach ($accordions as $accordion_id) {
                $this->crudRefreshProcess($accordion_id);
            }

            return true;
        }

        return false;
    }

    public function crudRefreshProcess($crud_id)
    {
        $crud = Crud::find($crud_id);

        if ($crud) {
            $crud_campos = $crud->toArray();
            $crud_campos['crud_id'] = $crud_id;
            $campos_array = json_decode($crud->campos, true);
            foreach ($campos_array as $campo) {
                $tablaCampo = $crud->nombre . '_' . $campo['field'];

                $crud_campos[$tablaCampo . '_indice'] = (isset($campo['indice']) ? $campo['indice'] : null);
                $crud_campos[$tablaCampo] = $campo['incluir_campo'];
                $crud_campos[$tablaCampo . '_list'] = $campo['incluir_list'];
                $crud_campos[$tablaCampo . '_alias'] = $campo['alias'];
                $crud_campos[$tablaCampo . '_help'] = (isset($campo['help']) ? $campo['help'] : null);

                $crud_campos[$tablaCampo . '_required'] = (isset($campo['required']) ? $campo['required'] : null);
                $crud_campos[$tablaCampo . '_readonly'] = (isset($campo['readonly']) ? $campo['readonly'] : null);
                $crud_campos[$tablaCampo . '_regex'] = (isset($campo['regex']) ? $campo['regex'] : null);
                $crud_campos[$tablaCampo . '_maxlength'] = (isset($campo['maxlength']) ? $campo['maxlength'] : null);

                $crud_campos[$tablaCampo . '_select'] = $campo['select'];
                $crud_campos[$tablaCampo . '_select_rules'] = (isset($campo['select_rules']) ? $campo['select_rules'] : null);
                $crud_campos[$tablaCampo . '_anidado'] = (isset($campo['anidado']) ? $campo['anidado'] : null);

                $crud_campos[$tablaCampo . '_crud_anidado_rules'] = (isset($campo['crud_anidado_rules']) ? $campo['crud_anidado_rules'] : null);

                $crud_campos[$tablaCampo . '_show_fk'] = (isset($campo['show_fk']) ? $campo['show_fk'] : null);
                $crud_campos[$tablaCampo . '_show_fk_permisos'] = (isset($campo['show_fk_permisos']) ? $campo['show_fk_permisos'] : null);
            }

            $result = $this->store($crud_campos);

            return $result;
        }
        return false;
    }

    public function crudRefreshAll()
    {
        $crudsRefresh = [];
        $cruds = Crud::where('estatus', 1)->get();

        if ($cruds) {
            foreach ($cruds as $crud_generado) {
                $campos_array = json_decode($crud_generado->campos);
                if ($campos_array) {
                    foreach ($campos_array as $campo) {
                        if (isset($campo->show_fk) && $campo->show_fk) {
                            //
                        } else {
                            $crudsRefresh[] = $crud_generado->id;
                        }
                    }
                }
            }

            foreach ($crudsRefresh as $crud) {
                $this->crudRefresh($crud);
            }

            return true;
        }

        return false;
    }

    public function getCrudAnidado($rules)
    {
        Log::info('GeneradorCrudService - getCrudAnidado');
        Log::info($rules);

        $crud_anidado = '';
        $rules = explode(';', $rules);
        $template_fields_select_crud_anidado = file_get_contents('../app/Crud/template_view_field_select_crud_anidado.php');
        $template_fields_select_crud_anidado_js = file_get_contents('../app/Crud/template_view_field_select_crud_anidado_js.php');

        $operator_field = '';
        $js_validation = '';

        foreach ($rules as $rule) {
            if ($rule) {
                $items = explode(',', $rule);
                $operator_field = $items[0];
                $operator_value = $items[2];
                $crud_asociado_id = $items[3];
                $crud_cantidad_registros = $items[4];
                $crud = Crud::find($crud_asociado_id);

                if ($crud) {
                    $template_crud_anidado =  $template_fields_select_crud_anidado;
                    $template_crud_anidado = str_replace('%CRUD_ANIDADO_TITLE%', $crud->alias_opcion, $template_crud_anidado);
                    $card_id = 'crud_anidado_' . $crud->nombre_componente . '_' . $operator_value;
                    $template_crud_anidado = str_replace('%CRUD_ANIDADO_ID%', $card_id, $template_crud_anidado);

                    $card_fieldset_id = 'crud_anidado_fieldset_' . $crud->nombre_componente . '_' . $operator_value;
                    $template_crud_anidado = str_replace('%CRUD_ANIDADO_FIELDSET_ID%', $card_fieldset_id, $template_crud_anidado);
                    $template_fields = file_get_contents("../resources/views/cruds/" . $crud->nombre_componente . "/fields.blade.php");
                    $crud_anidado_fields = '';

                    for ($i = 1; $i <= $crud_cantidad_registros; $i++) {
                        $fields_crud = $template_fields;
                        $crud_anidado_ref = $crud->nombre_componente . '_' . $i . '_';
                        $fields_crud = str_replace('name="', 'name="' . $crud_anidado_ref, $fields_crud);
                        $fields_crud = str_replace('id="', 'id="' . $crud_anidado_ref, $fields_crud);
                        $crud_anidado_fields .= $fields_crud;
                        $crud_anidado_fields .= '<hr class="primary text-primary">';
                    }

                    $template_crud_anidado = str_replace('%CRUD_ANIDADO_BODY%', $crud_anidado_fields, $template_crud_anidado);


                    $crud_anidado .= $template_crud_anidado;

                    $js_validation .= '
                    var ' . $card_id . ' = document.getElementById("' . $card_id . '");
                    var ' . $card_fieldset_id . ' = document.getElementById("' . $card_fieldset_id . '");
                    ' . $card_id . '.style.display = "none";
                    ' . $card_fieldset_id . '.disabled = true;

                    if (' . $operator_field . 'CrudElement.value == ' . $operator_value . ') {
                        ' . $card_id . '.style.display = "block";
                        ' . $card_fieldset_id . '.disabled = false;
                    }
                    ';
                }
            }
        }

        if ($operator_field) {
            $template_crud_anidado_js = $template_fields_select_crud_anidado_js;
            $template_crud_anidado_js = str_replace('%SELECT_CAMPO_ANIDADO%', $operator_field, $template_crud_anidado_js);
            $template_crud_anidado_js = str_replace('%SELECT_CAMPO_VALIDATION%', $js_validation, $template_crud_anidado_js);
            $crud_anidado .= $template_crud_anidado_js;
        }

        return $crud_anidado;
    }
}
