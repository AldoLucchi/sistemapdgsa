<?php

namespace App\Services;

use App\Models\Crud;
use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GeneradorCrudService
{

    /**
     * Store a newly created resource in storage.
     */
    public function store($request)
    {
        Log::info('GeneradorCrudServices - store');
        Log::info($request);

        try {

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
            $table_name_format = $table_name_format . $request['crud_id'];


            $table_crud = $request['nombre'];
            $table_crud_columns = DB::select("SHOW COLUMNS FROM " . $table_crud);
            $table_columns_string = "";

            $table_columns = $table_columns_all_null = [];
            $all_columns_null = true;
            $table_columns_all_null_string = '';
            $table_column_id = '';

            $tables_fk = [];

            foreach ($table_crud_columns as $colum) {
                $column_request = $table_crud . '_' . $colum->Field;
                $column_select_request = $table_crud . '_' . $colum->Field . '_select';

                $type_html = 'text'; //varchar text

                if (str_contains($colum->Type, 'tinyint')) {
                    $type_html = 'checkbox';
                } else if (str_contains($colum->Type, 'varchar') && (strtolower($colum->Field) == 'password')) {
                    $type_html = 'password';
                } else if (str_contains($colum->Type, 'varchar')) {
                    $type_html = 'text';
                } else if (str_contains($colum->Type, 'timestamp')) {
                    $type_html = 'datetime-local';
                } else if (str_contains($colum->Type, 'int')) {
                    $type_html = 'number';
                } else if (str_contains($colum->Type, 'char')) {
                    $type_html = 'checkbox';
                }

                $table_column_detail = ['name' => $colum->Field, 'type' => $colum->Type, 'type_html' => $type_html];
                if (isset($request[$column_select_request]) && !empty($request[$column_select_request]) &&  $column_select_request && $column_select_request != 'NULL' && $column_select_request != NULL) {
                    $table_column_detail['select'] = $request[$column_select_request];
                    $tables_fk[$colum->Field] = $request[$column_select_request];
                }

                //selected
                if (isset($request[$column_request])) {
                    $all_columns_null = false;

                    $table_columns[] =  $table_column_detail;
                    $table_columns_string .= "'" . $colum->Field . "',";
                }

                if ($colum->Key == 'PRI') {
                    $table_column_id = $colum->Field;
                }

                //all                
                $table_columns_all_null[] = $table_column_detail;
                $table_columns_all_null_string .= "'" . $colum->Field . "',";
            }



            if ($all_columns_null) {
                $table_columns =  $table_columns_all_null;
                $table_columns_string = $table_columns_all_null_string;
            }

            //Log::info('$table_columns -------');
            //Log::info($table_columns );

            //Log::info('$tables_fk -------');
            //Log::info($tables_fk );

            $tables_data_fk = [];
            foreach ($tables_fk as $key => $table_fk) {
                $table_fk_columns = DB::select("SHOW COLUMNS FROM " . $table_fk);
                $table_columns_all_string = '';
                $table_column_fk_id = '';
                $table_column_fk_name = '-';
                $i = 1;
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

                $table_name_fk_substr = substr($table_fk, 4);
                if ($table_fk == 'users') {
                    $table_name_fk_substr = $table_fk;
                }
                $table_name_fk_array = explode("_", $table_name_fk_substr);
                $table_name_fk_format = '';
                foreach ($table_name_fk_array as $tring) {
                    $table_name_fk_format .= ucfirst($tring);
                }
                //$table_name_fk_substr = str_replace('_', '', $table_name_fk_substr);

                //$table_name_fk_substr_ucfirst =ucfirst($table_name_fk_substr );
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

            //Log::info('$tables_data_fk ----');
            //Log::info($tables_data_fk );

            $data = [
                'table_fullname' => $table_crud,
                'table_name' => $table_name_format,
                'table_name_label' => $table_name_label,
                'table_columns' =>  $table_columns,
                'table_columns_string' =>  $table_columns_string,
                'table_column_id' => $table_column_id,
                'tables_fk' => $tables_data_fk,
                'model_name' => $table_name_format,
                'controller_name' => $table_name_format . 'Controller',
                'datatable_name' => $table_name_format . 'DataTable',
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
        $this->generateCrudController($data);
        $this->generateCrudViews($data);
        $this->generateCrudDatatable($data);
        $this->generateCrudLivewire($data);
        //$this->generateCrudRoute($data);
        //$this->generateCrudMenu($data);
        //$this->generateCrudBreadcrumb($data);

        //dd($table_columns);

        $this->limpiarCache();
    }


    public function generateRutaBreadcrumb($crudMenu)
    {
        $data = [];
        if($crudMenu->menu && $crudMenu->crud){
            $data = [
                'menu' => ['nombre' => $crudMenu->menu->menu, 'ruta' => $crudMenu->menu->ruta],
                'item' => ['nombre' => $crudMenu->crud->nombre_componente, 'alias' => $crudMenu->crud->alias_opcion],
            ];

            $this->generateRoute($data);
            $this->generateBreadcrumb($data);
            $this->replaceActions($data);
    
            //dd($table_columns);
    
            $this->limpiarCache();
        }
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
            $relation ='';

            if($table['table_name_fk'] == 'Users'){
                $relation = '
                public function ' . $table['table_name_fk'] . '() { return $this->hasMany(' . $table['model_name'] . '::class,"id","' . $key . '"); }
                    ';
            }
            else{
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

        $fields_checkobx = '';
        foreach ($data['table_columns'] as $column) {
            if ($column['type_html'] == 'checkbox') {
                $field_checkbox = '
                $request["' . $column['name'] . '"] = ( isset($request["' . $column['name'] . '"])?1:0); 
                ';
                $fields_checkobx .= $field_checkbox;
            }
        }

        $template_controller = str_replace('%FIELD_CHECKBOX%', $fields_checkobx, $template_controller);

        fwrite($file_controller, $template_controller);
        fclose($file_controller);
    }

    public function generateCrudViews($data)
    {

        //create dir views
        if (!is_dir("../resources/views/cruds")) {
            mkdir("../resources/views/cruds");
        }

        if (!is_dir("../resources/views/cruds/" . $data['table_name'])) {
            mkdir("../resources/views/cruds/" . $data['table_name']);
        }
        if (!is_dir("../resources/views/cruds/" . $data['table_name'] . '/columns')) {
            mkdir("../resources/views/cruds/" . $data['table_name'] . '/columns');
        }

        //create views
        $file_list_view = fopen("../resources/views/cruds/" . $data['table_name'] . "/list.blade.php", "w") or die("Unable to open file - view list.blade.php");
        $template_list_view = file_get_contents('../app/Crud/template_view_list.php');
        $template_list_view = $this->generateCrudReplace($template_list_view, $data);

        fwrite($file_list_view, $template_list_view);
        fclose($file_list_view);

        //show
        $file_show_view = fopen("../resources/views/cruds/" . $data['table_name'] . "/show.blade.php", "w") or die("Unable to open file - view show.blade.php");
        $template_list_show = file_get_contents('../app/Crud/template_view_show.php');
        $template_list_show = $this->generateCrudReplace($template_list_show, $data);

        fwrite($file_show_view, $template_list_show);
        fclose($file_show_view);

        //show field
        $file_fields = fopen("../resources/views/cruds/" . $data['table_name'] . "/fields.blade.php", "w") or die("Unable to open file - view fields.blade.php");
        $template_fields = file_get_contents('../app/Crud/template_view_show_field.php');
        $fields_all = '';
        foreach ($data['table_columns'] as $column) {
            $template = $template_fields;
            $template = str_replace('%FIELD%', $column['name'], $template);

            $value = '';
            if (isset($column['select'])) {
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $value = '$' . $data['table_name'] . '->' . $model_name . '->first()?->' . $column_name;
            } else {
                $value = '$' . $data['table_name'] . '->' . $column['name'];
                if ($column['type_html'] == 'checkbox') {
                    $value = '($' . $data['table_name'] . '->' . $column['name'] . '?"ON":"OFF")';
                }
                if ($column['type_html'] == 'password') {
                    $value = '"---"';
                }
            }

            $template = str_replace('%FIELD_VALUE_SHOW%', $value, $template);

            $fields_all .= $template;
        }

        $fields_all = $this->generateCrudReplace($fields_all, $data);

        fwrite($file_fields, $fields_all);
        fclose($file_fields);



        $file_action_view = fopen("../resources/views/cruds/" . $data['table_name'] . "/columns/_actions.blade.php", "w") or die("Unable to open file - view actions.blade.php");
        $template_list_actions = file_get_contents('../app/Crud/template_view_actions.php');
        $template_list_actions = $this->generateCrudReplace($template_list_actions, $data);

        fwrite($file_action_view, $template_list_actions);
        fclose($file_action_view);

        $file_draw_scripts_view = fopen("../resources/views/cruds/" . $data['table_name'] . "/columns/_draw-scripts.js", "w") or die("Unable to open file - view _draw-scripts.js");
        $template_list_draw_js = file_get_contents('../app/Crud/template_view_draw_js.php');
        $template_list_draw_js = $this->generateCrudReplace($template_list_draw_js, $data);

        fwrite($file_draw_scripts_view, $template_list_draw_js);
        fclose($file_draw_scripts_view);

        //view table
        $file_table = fopen("../resources/views/cruds/" . $data['table_name'] . "/columns/_table.blade.php", "w") or die("Unable to open file - view table.blade.php");

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

        Log::info('generateCrudDatatable---------');
        //Log::info($data['table_columns']);
        foreach ($data['table_columns'] as $column) {
            if (isset($column['select'])) {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $column['name'], $template_fields_replace);
                $model_name = $data['tables_fk'][$column['name']]['table_name_fk'];
                $column_name = $data['tables_fk'][$column['name']]['table_column_fk_name'];
                $return = '$%OBJETO_VARIABLE%->' . $model_name . '->first()?->' . $column_name; //ucwords($user->roles->first()?->name);
                $template_fields_replace = str_replace('%DATATABLE_RETURN%', $return, $template_fields_replace);
                $template_fields_replace = $this->generateCrudReplace($template_fields_replace, $data);
                $template_fields_all .=  $template_fields_replace;
            } else {
                $template_fields_replace = $template_fields;
                $template_fields_replace = str_replace('%FIELD%', $column['name'], $template_fields_replace);
                if ($column['type_html'] == 'checkbox') {
                    $return = '($%OBJETO_VARIABLE%->' . $column['name'] . '?"ON":"OFF")';
                } else if ($column['type_html'] == 'password') {
                    $return = '"---"';
                } else {
                    $return = '$%OBJETO_VARIABLE%->' . $column['name'];
                }
                $template_fields_replace = str_replace('%DATATABLE_RETURN%', $return, $template_fields_replace);
                $template_fields_replace = $this->generateCrudReplace($template_fields_replace, $data);
                $template_fields_all .=  $template_fields_replace;
            }
        }

        //columns
        $template_columns = file_get_contents('../app/Crud/template_datatable_getcolumns.php');
        $template_columns = $this->generateCrudReplace($template_columns, $data);
        $template_columns_all = '';
        foreach ($data['table_columns'] as $column) {
            $template_columns_replace = $template_columns;
            $template_columns_replace = str_replace('%FIELD%', $column['name'], $template_columns_replace);
            $template_columns_all .=  $template_columns_replace;
        }

        $template = file_get_contents('../app/Crud/template_datatable.php');
        $template = $this->generateCrudReplace($template, $data);

        $template = str_replace('%FIELDS_DATATABLES_DATATABLE%', $template_fields_all, $template);
        $template = str_replace('%FIELDS_DATATABLES_GETCOLUMNS%', $template_columns_all, $template);

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
        $table_name = $data['table_name'];

        $livewire_select = '';
        $livewire_select_use = '';

        foreach ($data['table_columns'] as $column) {
            $column_name = $column['name'];
            $column_type_html = $column['type_html'];

            if($column['type_html'] == 'checkbox'){
                $columnConst = '
                public bool $' . $column['name'] . ';
                ';
            }
            else{
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
            $this->' . $column_name . ' = $' . $table_name . '->' . $column_name . ';
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
        if (!is_dir("../resources/views/livewire/" . $data['table_name'])) {
            mkdir("../resources/views/livewire/" . $data['table_name']);
        }

        $file_list = fopen("../resources/views/livewire/" . $data['table_name'] . "/list.blade.php", "w") or die("Unable to open file - view list.blade.php");
        $template_list = file_get_contents('../app/Crud/template_livewire_view_list.php');
        $template_list = $this->generateCrudReplace($template_list, $data);

        fwrite($file_list, $template_list);
        fclose($file_list);

        //Modal
        $file_modal = fopen("../resources/views/livewire/" . $data['table_name'] . "/add-" . $data['table_name'] . "-modal.blade.php", "w") or die("Unable to open file - view add-modal.blade.php");
        $template_modal = file_get_contents('../app/Crud/template_livewire_view_modal.php');
        $template_modal = $this->generateCrudReplace($template_modal, $data);

        fwrite($file_modal, $template_modal);
        fclose($file_modal);


        $file_fields = fopen("../resources/views/livewire/" . $data['table_name'] . "/fields.blade.php", "w") or die("Unable to open file - view fields.blade.php");
        $template_fields = file_get_contents('../app/Crud/template_livewire_view_modal_fields.php');

        $template_modal_fields = '<div class="row">';
        foreach ($data['table_columns'] as $column) {
            $column_name = $column['name'];
            $column_type_html = $column['type_html'];

            if ($column_name != $data['table_column_id']) {
                $template = $template_fields;
                $template = str_replace('%FIELD%', $column_name, $template);

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
                    if ($column_type_html == 'checkbox') {
                        $class = 'form-check-input mb-3 mb-lg-0';
                    }
                    $input = '<input type="' . $column_type_html . '" wire:model="' . $column_name . '" name="' . $column_name . '" class="' . $class . '" placeholder="' . $column_name . '" />';
                }

                $template = str_replace('%INPUT_FIELD%', $input, $template);
                $template_modal_fields .= $template;
            }
        }
        $template_modal_fields .= '</div>';

        fwrite($file_fields, $template_modal_fields);
        fclose($file_fields);
    }

    public function generateRoute($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];
        $rutas = file_get_contents('../routes/web_crud.php');
        $search = "'/" . $menu_ruta . "/" . $item_nombre . "'";

        if (!str_contains($rutas, $search)) {
            //create route

            $new_route = "
        use App\Http\Controllers\Crud\\" . $item_nombre . "Controller;
        Route::name('" . $menu_ruta . ".')->group(function () {
            Route::resource('/" . $menu_ruta . "/" . $item_nombre . "', " . $item_nombre . "Controller::class);
        }); 
        ";
            $template_route = file_put_contents('../routes/web_crud.php', $new_route . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    public function replaceActions($data){
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/columns/_actions.blade.php');

        
        $file = fopen("../resources/views/cruds/" . $item_nombre . "/columns/_actions.blade.php", "w") or die("Unable to open file - view actions.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);
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

    public function generateBreadcrumb($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $menu_label = $data['menu']['nombre'];
        $crud_nombre = $data['item']['nombre'];
        $crud_alias = $data['item']['alias'];

        $breadcrumbs = file_get_contents('../routes/breadcrumbs.php');
        $search_parent = $menu_ruta . '.index';

        if (!str_contains($breadcrumbs, $search_parent)) {

            //create 
            $content = file_get_contents('../app/Crud/template_breadcrumb_parent.php');
            $content = str_replace('%MENU%', $menu_ruta, $content);
            $content = str_replace('%MENU_LABEL%', $menu_label, $content);
            $content = str_replace('%OBJETO%', $crud_nombre, $content);
            $content = str_replace('%OBJETO_LABEL%', $crud_alias, $content);
            $content = str_replace('%OBJETO_ROUTE%', $crud_nombre, $content);
            $content = str_replace('%OBJETO_VARIABLE%', $crud_nombre, $content);

            $template = file_put_contents('../routes/breadcrumbs.php', $content . PHP_EOL, FILE_APPEND | LOCK_EX);
        }

        //$breadcrumbs = file_get_contents('../routes/breadcrumbs.php');
        $search = $menu_ruta . '.' . $crud_nombre . '.index';

        if (!str_contains($breadcrumbs, $search)) {

            //create 
            $content = file_get_contents('../app/Crud/template_breadcrumb.php');
            $content = str_replace('%MENU%', $menu_ruta, $content);
            $content = str_replace('%OBJETO%', $crud_nombre, $content);
            $content = str_replace('%OBJETO_LABEL%', $crud_alias, $content);
            $content = str_replace('%OBJETO_ROUTE%', $crud_nombre, $content);
            $content = str_replace('%OBJETO_VARIABLE%', $crud_nombre, $content);

            $template = file_put_contents('../routes/breadcrumbs.php', $content . PHP_EOL, FILE_APPEND | LOCK_EX);
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
        $menu = file_get_contents('../routes/web_crud.php');
        $search = $this->generateCrudReplace("'/crud/%OBJETO_VIEW%'", $data);

        if (!str_contains($menu, $search)) {

            //create route

            $new_route = "
        use App\Http\Controllers\Crud\%OBJETO%Controller;
        Route::resource('/crud/%OBJETO_VIEW%', %OBJETO%Controller::class);
        ";
            $new_route = $this->generateCrudReplace($new_route, $data);

            $template_route = file_put_contents('../routes/web_crud.php', $new_route . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    public function generateCrudReplace($content, $data)
    {
        $content = str_replace('%OBJETO%', $data['model_name'], $content);
        $content = str_replace('%OBJETO_LABEL%', $data['table_name_label'], $content);
        $content = str_replace('%TABLA%', $data['table_fullname'], $content);
        $content = str_replace('%TABLA_CAMPOS%', $data['table_columns_string'], $content);
        $content = str_replace('%FIELD_ID%', $data['table_column_id'], $content);

        $content = str_replace('%OBJETO_CONTROLLER%', $data['controller_name'], $content);
        $content = str_replace('%SELECT_USE%', '', $content);
        $content = str_replace('%OBJETO_VIEW%', $data['table_name'], $content);
        $content = str_replace('%OBJETO_VARIABLE%', $data['table_name'], $content);
        $content = str_replace('%OBJETO_DATATABLE%', $data['datatable_name'], $content);

        $content = str_replace('%OBJETO_ROUTE%', $data['table_name'], $content);

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
        //Artisan::call('cache:clear');
        //Artisan::call('config:clear');
        //Artisan::call('view:clear');
        //Artisan::call('route:clear');
        //artisan optimize:clear
        Artisan::call('optimize:clear');
    }
}
