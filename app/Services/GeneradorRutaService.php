<?php

namespace App\Services;

use Illuminate\Support\Facades\Artisan;

class GeneradorRutaService
{

    public function generateRutaBreadcrumb($crudMenu)
    {
        $data = [];
        if ($crudMenu->menu && $crudMenu->crud) {
            $data = [
                'menu' => ['nombre' => $crudMenu->menu->menu, 'ruta' => $crudMenu->menu->ruta],
                'item' => ['nombre' => $crudMenu->crud->nombre_componente, 'alias' => $crudMenu->crud->alias_opcion],
            ];

            $this->generateRoute($data);
            //$this->generateBreadcrumb($data);
            //$this->replaceRutasActions($data);
            //$this->replaceRutasControllers($data);
            //$this->replaceRutasDatatables($data);
            //$this->replaceRutasViews($data);

            //dd($table_columns);

            $this->limpiarCache();
        }
    }

    public function generateRoute($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        //create route
        $item_controller = $item_nombre . "Controller";
        $item_datatable = $item_nombre . "DataTable";

        $new_route = "
            <?php 


        use App\Http\Controllers\Crud\\" . $item_controller . ";
        Route::name('" . $menu_ruta . ".')->group(function () {
            Route::resource('/" . $menu_ruta . "/" . $item_nombre . "', " . $item_controller . "::class);
        }); 
        Route::get('" . $menu_ruta . "/" . $item_datatable . "',[" . $item_controller . "::class, 'get" . $item_datatable . "'])->name('" . $menu_ruta . "." . $item_datatable . "');
        Route::get('" . $menu_ruta . "/" . $item_datatable . "/create',[$item_controller ::class, 'create'])->name('" . $item_datatable . ".create');

                ";

        $new_route_item = "web_crud_" . $item_nombre . ".php";

        $file_route = fopen("../routes/" . $new_route_item, "w") or die("Unable to open file - web_crud_ " . $item_nombre);
        fwrite($file_route, $new_route);
        fclose($file_route);

        $new_route_crud = "    
            require __DIR__ . '/" . $new_route_item . "';
            ";

        $rutas = file_get_contents('../routes/web_crud.php');
        $search = $new_route_item;

        if (!str_contains($rutas, $search)) {
            $template_route = file_put_contents('../routes/web_crud.php', $new_route_crud . PHP_EOL, FILE_APPEND | LOCK_EX);
        }
    }

    public function replaceRutasActions($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/columns/_actions.blade.php');


        $file = fopen("../resources/views/cruds/" . $item_nombre . "/columns/_actions.blade.php", "w") or die("Unable to open file - view actions.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);
    }

    public function replaceRutasControllers($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        $content = file_get_contents("../app/Http/Controllers/Crud/" . $item_nombre . "Controller.php");

        $file = fopen("../app/Http/Controllers/Crud/" . $item_nombre . "Controller.php", "w") or die("Unable to open file - controller " . $item_nombre);

        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);
    }

    public function replaceRutasDatatables($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        $content = file_get_contents("../app/DataTables/" . $item_nombre . "DataTable.php");

        $file = fopen("../app/DataTables/" . $item_nombre . "DataTable.php", "w") or die("Unable to open file - datatable  " . $item_nombre);

        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);
    }

    public function replaceRutasViews($data)
    {
        $menu_ruta = $data['menu']['ruta'];
        $item_nombre = $data['item']['nombre'];

        //list
        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/list.blade.php');

        $file = fopen("../resources/views/cruds/" . $item_nombre . "/list.blade.php", "w") or die("Unable to open file - view list.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);

        //create
        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/create.blade.php');

        $file = fopen("../resources/views/cruds/" . $item_nombre . "/create.blade.php", "w") or die("Unable to open file - view create.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);

        //edit
        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/edit.blade.php');

        $file = fopen("../resources/views/cruds/" . $item_nombre . "/edit.blade.php", "w") or die("Unable to open file - view edit.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);

        //show
        $content = file_get_contents('../resources/views/cruds/' . $item_nombre . '/show.blade.php');

        $file = fopen("../resources/views/cruds/" . $item_nombre . "/show.blade.php", "w") or die("Unable to open file - view show.blade.php");
        $content = str_replace('%MENU_RUTA%', $menu_ruta, $content);

        fwrite($file, $content);
        fclose($file);
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

    public function limpiarCache()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        //Artisan::call('route:clear');
        //artisan optimize:clear
        Artisan::call('optimize:clear');
    }
}
