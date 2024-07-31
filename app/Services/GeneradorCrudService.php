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

            $table_crud_columns = DB::select("SHOW COLUMNS FROM " . $table_crud);
            $table_columns_string = "";

            $table_columns = $table_columns_all_null = [];
            $all_columns_null = true;
            $table_columns_all_null_string = '';
            $table_column_id = '';
            $table_column_name = '';
            $k = 1;

            $tables_fk = [];
            $tables_crud_relation_fk = [];

            foreach ($table_crud_columns as $colum) {
                $column_request = $table_crud . '_' . $colum->Field;
                $column_select_request = $table_crud . '_' . $colum->Field . '_select';
                $column_select_id = $table_crud . '_' . $colum->Field . '_select_id';
                $column_select_alias = $table_crud . '_' . $colum->Field . '_alias';
                $column_select_list = $table_crud . '_' . $colum->Field . '_list';
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

                //alias
                if (isset($request[$column_select_alias]) && !empty($request[$column_select_alias]) &&  $column_select_alias && $column_select_alias != 'NULL' && $column_select_alias != NULL) {
                    $table_column_detail['alias'] = $request[$column_select_alias];
                }

                //fk
                if (isset($request[$column_select_request]) && !empty($request[$column_select_request]) &&  $column_select_request && $column_select_request != 'NULL' && $column_select_request != NULL) {
                    $table_column_detail['select'] = $request[$column_select_request];
                    $tables_fk[$colum->Field] = $request[$column_select_request];

                    if (isset($request[$column_select_id]) && !empty($request[$column_select_id]) &&  $column_select_id && $column_select_id != 'NULL' && $column_select_id != NULL) {
                        $table_column_detail['select_id'] = $request[$column_select_id];
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

                //in list
                if (isset($request[$column_select_list]) && !empty($request[$column_select_list]) &&  $column_select_list && $column_select_list != 'NULL' && $column_select_list != NULL) {
                    $table_column_detail['incluir_list'] = $request[$column_select_list];
                }

                //incude field
                if (isset($request[$column_request])) {
                    $all_columns_null = false;

                    $table_columns[] =  $table_column_detail;
                    $table_columns_string .= "'" . $colum->Field . "',";
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
                $table_columns_all_null[] = $table_column_detail;
                $table_columns_all_null_string .= "'" . $colum->Field . "',";
            }

            // all columns o selected columns
            if ($all_columns_null) {
                $table_columns =  $table_columns_all_null;
                $table_columns_string = $table_columns_all_null_string;
            }


            //fk tables----
            $tables_data_fk = [];
            foreach ($tables_fk as $key => $table_fk) {
                $table_fk_columns = DB::select("SHOW COLUMNS FROM " . $table_fk);
                $table_columns_all_string = '';
                $table_column_fk_id = '';
                $table_column_fk_name = '-';
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

        //dd($table_columns);

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
        foreach ($data['tables_fk'] as $key => $table) {
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
        //create controller

        //create dir 
        if (!is_dir("../app/Http/Controllers/Crud/")) {
            mkdir("../app/Http/Controllers/Crud/");
        }

        $file_controller = fopen("../app/Http/Controllers/Crud/" . $data['controller_name'] . ".php", "w") or die("Unable to open file - Model " . $data['controller_name']);
        $template_controller = file_get_contents('../app/Crud/template_controller.php');
        $template_controller = $this->generateCrudReplace($template_controller, $data);

        $template_controller_file = file_get_contents('../app/Crud/template_controller_file.php');

        $fields_checkobx = '';
        $tablas_asociadas = '';
        $tablas_asociadas_uses = '';
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
            "%OBJETO_VARIABLE%List" => %OBJETO_VARIABLE%::%VARIABLE_CONDITION%->get(),
        ';

        $template_filters_variables = '
            "%OBJETO_VARIABLE%" => $request["%OBJETO_VARIABLE%"],
        ';

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

                $condition = '';

                if (isset($column['select_id'])) {
                    $condition = 'whereIn("' . $column_id_fk . '",[' . $column['select_id'] . '])';
                } else {
                    $condition = 'whereRaw("1 = 1")';
                }

                $tabla = '
                "' . $model_name_fk . '" => ' . $model_name_fk . '::' . $condition . '->get(), 
                ';

                $use = '
                use App\Models\\' . $model_name_fk . ';
                ';

                $tablas_asociadas .= $tabla;

                $tablas_asociadas_uses .= $use;

                //filter
                $filter = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter);
                $filtersControllerIndex .= $filter;

                $filter_variable = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter_variable);
                $filters_variables .= $filter_variable;

                $filter_variable_all = str_replace('%OBJETO_VARIABLE%', $model_name_fk, $filter_variable_all);

                $filter_variable_all = str_replace('%VARIABLE_CONDITION%', $condition, $filter_variable_all);
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

                $tabla = '
                "etiquetasDocumentos" => EtiquetasDocumentos104::orderBy("alias","ASC")->get(), 
                ';

                $use = '
                use App\Models\EtiquetasDocumentos104;
                ';

                $tablas_asociadas .= $tabla;
                $tablas_asociadas_uses .= $use;

                /*
                    $pdf = '
                    $html = $' . $data['model_name'] . '->' . $column['name'] . ';
                    $html = $this->etiquetasDocumentosService->replaceVariables($html, $' . $data['model_name'] . '->' . $data['table_column_id'] . ');
                    $pdf = App::make("dompdf.wrapper");
                    Log::info($html);
                    $pdf->loadHTML($html);
                    $pdf->save(public_path() . "/docs/' . $data['model_name'] . '_" . $' . $data['model_name'] . '->' . $data['table_column_id'] . ' . ".pdf");
                ';
                */
            }
        }

        $template_controller = str_replace('%FIELD_CHECKBOX%', $fields_checkobx, $template_controller);
        $template_controller = str_replace('%TABLAS_ASOCIADAS%', $tablas_asociadas, $template_controller);
        $template_controller = str_replace('%TABLAS_ASOCIADAS_USE%', $tablas_asociadas_uses, $template_controller);
        $template_controller = str_replace('%FIELD_FILE_STORAGE%', $field_file_storage, $template_controller);
        $template_controller = str_replace('%FILTERS_CONTROLLER_INDEX%', $filtersControllerIndex, $template_controller);
        $template_controller = str_replace('%FILTERS_VARIABLES%', $filters_variables, $template_controller);
        $template_controller = str_replace('%FIELD_PDF%', $pdf, $template_controller);

        fwrite($file_controller, $template_controller);
        fclose($file_controller);
    }

    public function generateCrudViews($data)
    {

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

        $template_list_filters = file_get_contents('../app/Crud/template_view_list_filters.php');
        $template_list_filters_date = file_get_contents('../app/Crud/template_view_list_filters_date.php');
        $template_list_filters_javascript = '
        const %OBJETO_LABEL% = document.getElementById("%OBJETO_LABEL%").value;            
            urlFilter = urlFilter+ "%OBJETO_LABEL%="+%OBJETO_LABEL%+"&";
            ';

        $template_filters = '';
        $template_filters_javascript = '';

        foreach ($data['table_columns'] as $column) {
            if (isset($column['select'])) {
                $list_filters = $template_list_filters;
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
                $list_filters_javascript = str_replace('%OBJETO_LABEL%', $model_name, $list_filters_javascript);

                $template_filters_javascript .= $list_filters_javascript;
            }

            if (in_array($column['type_html'], ['date', 'datetime-local'])) {
                $list_filters_date = $template_list_filters_date;
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
                $list_filters_javascript_from = str_replace('%OBJETO_LABEL%', $date_from, $list_filters_javascript_from);
                $template_filters_javascript .= $list_filters_javascript_from;

                $date_to = $column['name'] . '_to';
                $list_filters_javascript_to = str_replace('%OBJETO_LABEL%', $date_to, $list_filters_javascript_to);
                $template_filters_javascript .= $list_filters_javascript_to;
            }
        }

        $template_list_view = str_replace('%VIEW_LIST_FILTROS%', $template_filters, $template_list_view);
        $template_list_view = str_replace('%VIEW_LIST_FILTROS_JAVASCRIPT%', $template_filters_javascript, $template_list_view);

        fwrite($file_list_view, $template_list_view);
        fclose($file_list_view);

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
        $template_fields = file_get_contents('../app/Crud/template_view_show_field.php');
        $template_fields_select = file_get_contents('../app/Crud/template_view_show_field_select.php');
        $template_fields_html = file_get_contents('../app/Crud/template_view_show_field_html.php');

        $fields_all = '';
        $action_documento = '';

        foreach ($data['table_columns'] as $column) {
            $template = '';

            $show_column_name = $column['name'];
            $show_column_name_alias = $column['name'];

            if (isset($column['alias'])) {
                $show_column_name_alias = $column['alias'];
            }

            $value = '';

            if (isset($column['select'])) {
                $template = $template_fields_select;
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $column_id = $data['tables_fk'][$column['name']]['table_column_fk_id'];

                $value = '
                    @foreach($' . $model_name . ' as $item)
                    <option value="{{ $item->' . $column_id . ' }}"  {{ (isset($' . $data['crud_name'] . ') && $item->' . $column_id . ' == $' . $data['crud_name'] . '->' . $show_column_name . ')?"selected":"" }}>{{ $item->' . $column_name . ' }}</option>
                    @endforeach';

                $template = str_replace('%FIELD_SELECT_OPTIONS%', $value, $template);
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
                $template = $template_fields;

                $template = str_replace('%FIELD_TYPE%', $column['type_html'], $template);

                $value = '( isset($' . $data['crud_name'] . ')?$' . $data['crud_name'] . '->' . $column['name'] . ':"")';
                $value_file = '';
                $value_readonly = "";

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
                    <img src="/images/{{ $' . $data['crud_name'] . '->' . $column['name'] . ' }}" style="width:250px;">
                    </a>
                    @endif
                    ';

                    $show_column_name = $show_column_name . '_file';
                }
                if ($data['table_column_id'] == $column['name']) {
                    $value_readonly = "readonly";
                }

                $template = str_replace('%FIELD_VALUE_SHOW%', $value, $template);
                $template = str_replace('%FIELD_FILE%', $value_file, $template);
                $template = str_replace('%FIELD_READONLY%', $value_readonly, $template);
                $template = str_replace('%FIELD_STYLE%', $field_style, $template);
                $template = str_replace('%FIELD_CHECKED%', $field_checked, $template);
            }

            $template = str_replace('%FIELD%', $show_column_name, $template);
            $template = str_replace('%FIELD_ALIAS%', $show_column_name_alias, $template);

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
        //create datatable

        $file = fopen("../app/DataTables/" . $data['datatable_name'] . ".php", "w") or die("Unable to open file - datatable " . $data['datatable_name']);

        //fields
        $template_fields = file_get_contents('../app/Crud/template_datatable_datatable.php');
        $template_fields = $this->generateCrudReplace($template_fields, $data);
        $template_fields_all = '';
        $incluir_list = false;
        $template_fields_list = '';

        Log::info('generateCrudDatatable---------');
        //Log::info($data['table_columns']);
        foreach ($data['table_columns'] as $column) {
            $datatable_column_name = $column['name'];
            if (isset($column['alias']) && $column['name'] != $data['table_column_id']) {
                $datatable_column_name = $column['alias'];
            }
            if (isset($column['select'])) {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $datatable_column_name, $template_fields_replace);
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $return = '$%OBJETO_VARIABLE%->' . $model_name . '->first()?->' . $column_name; //ucwords($user->roles->first()?->name);

            } else {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $datatable_column_name, $template_fields_replace);

                if ($column['type_html'] == 'checkbox') {
                    $return = '($%OBJETO_VARIABLE%->' . $column['name'] . '?"ON":"OFF")';
                } else if ($column['type_html'] == 'password') {
                    $return = '"---"';
                } else if ($column['type_html'] == 'file') {
                    $return = 'new HtmlString(\'
                    <a href="/images/' . '\'.$' . $data['model_name'] . '->' . $column['name'] . '.\'" target="_blank">
                    <img src="/images/' . '\'.$' . $data['model_name'] . '->' . $column['name'] . '.\'" border="0" width="40" class="img-rounded" />
                    </a>
                    \')';
                } else {
                    $return = 'mb_convert_encoding( $%OBJETO_VARIABLE%->' . $column['name'] . ', "UTF-8", "UTF-8")';
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

        $template_filters_texto = '';

        foreach ($data['table_columns'] as $column) {
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
        $template = str_replace('%DATATABLE_QUERY_FILTERS%', $template_datatable_queries_all, $template);
        $template = str_replace('%DATATABLE_QUERY_FILTERS_DYNAMIC%', $filters, $template);
        $template_filters_texto = substr($template_filters_texto, 0, -1);
        $template = str_replace('%DATATABLE_QUERY_FILTERS_DYNAMIC_TEXTO%', $template_filters_texto, $template);

        fwrite($file, $template);
        fclose($file);
    }


    public function generateCrudLivewire($data)
    {
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
                    $link = '<a href="{{ route("' . $tableNameDatatable . '.create") }}?' . $keyCrud . '={{ $' . $componentName . '->' . $keyCrud . ' }}" class="btn btn-primary float-end"> Agregar</a> ';
                    $template_datatable = str_replace("%CREATE%", $link, $template_datatable);
                } else {
                    $template_datatable = str_replace("%CREATE%", '', $template_datatable);
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
        $content = str_replace('%SELECT_USE%', '', $content);
        $content = str_replace('%OBJETO_VIEW%', $data['crud_name'], $content);
        $content = str_replace('%OBJETO_VARIABLE%', $data['crud_name'], $content);
        $content = str_replace('%OBJETO_DATATABLE%', $data['datatable_name'], $content);

        $content = str_replace('%OBJETO_ROUTE%', $data['crud_name'], $content);

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
}
