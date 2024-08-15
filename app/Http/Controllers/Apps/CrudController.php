<?php

namespace App\Http\Controllers\Apps;

use App\DataTables\CrudDataTable;
use App\Http\Controllers\Controller;
use App\Models\Crud;
use App\Services\CrudService;
use App\Services\GeneradorCrudService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CrudController extends Controller
{
    private $crudService;
    private $generadorCrudService;

    public function __construct(
        CrudService $crudService,
        GeneradorCrudService $generadorCrudService
    ) {
        $this->crudService = $crudService;
        $this->generadorCrudService = $generadorCrudService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CrudDataTable $dataTable)
    {
        return $dataTable->render('admin.crud.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cruds_created = []; //Crud::pluck('name')->toArray();
        $cruds_availables = $cruds_filtered =  $cruds_filtered_columns = [];
        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects  
        $tables_excluded_env = env('CRUD_TABLES_EXCLUDED', 'addresses,cruds,failed_jobs,migrations,model_has_permissions,model_has_roles,password_resets,permissions,personal_access_tokens,role_has_permissions,roles');
        $tables_excluded = explode(',', $tables_excluded_env);

        $options_crud = [
            'create' => 'create',
            'read' => 'read',
            'update' => 'update',
            'delete' => 'delete',
        ];

        $cruds_generated = Crud::all();
        $tables_in = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $i => $crud_table) {

            $table_name = $crud_table->$tables_in;

            if (!in_array($table_name, $tables_excluded)) {
                $cruds_availables[$i] = $crud_table->$tables_in;
                if (!array_search($table_name, $cruds_created)) {
                    $cruds_filtered[$i] = $crud_table->$tables_in ?? '';
                    $cruds_filtered_columns[$table_name] = DB::select("SHOW COLUMNS FROM " . $table_name);
                }
            }
        }

        $data = [
            'cruds_availables' => $cruds_availables,
            'cruds_filtered' => $cruds_filtered,
            'cruds_filtered_columns' => $cruds_filtered_columns,
            'cruds_generated' => $cruds_generated,
            'options_crud' => $options_crud,
        ];

        return view('admin.crud.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('CrudController - store');
        Log::info($request);

        $validated = $request->validate([
            'nombre' => 'required',
            'alias_opcion' => 'required',
        ]);

        try {
            $request['estatus'] = 1;
            $crud = $this->crudService->store($request->all());

            if ($crud) {
                $request['crud_id'] = $crud->id;


                $crudGenerado = $this->generadorCrudService->store($request->all());

                if ($crudGenerado) {
                    $message = 'Proceso completado. CRUD generado correctamente';

                    return redirect('/admin/crud')->with('message', $message);
                }
            }
        } catch (Exception $e) {
            return redirect('/admin/crud')->with('message-error', $e->getMessage());
        }
        return redirect('/admin/crud')->with('message-error', 'No se ha podido completar la generación de CRUD');
    }



    /**
     * Show the form for editing a new resource.
     */
    public function edit($crud_id)
    {
        $crud = Crud::find($crud_id);
        $crud_campos = ((isset($crud->campos) && $crud->campos )?json_decode($crud->campos):[]);
        $cruds_created = []; //Crud::pluck('name')->toArray();
        $cruds_availables = $cruds_filtered =  $cruds_filtered_columns = [];
        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects  
        $tables_excluded_env = env('CRUD_TABLES_EXCLUDED', 'addresses,cruds,failed_jobs,migrations,model_has_permissions,model_has_roles,password_resets,permissions,personal_access_tokens,role_has_permissions,roles');
        $tables_excluded = explode(',', $tables_excluded_env);

        $options_crud = [
            'create' => 'create',
            'read' => 'read',
            'update' => 'update',
            'delete' => 'delete',
        ];

        $cruds_generated = Crud::all();

        $tables_in = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $i => $crud_table) {
            $table_name = $crud_table->$tables_in;

            if (!in_array($table_name, $tables_excluded)) {
                $cruds_availables[$i] = $crud_table->$tables_in;
                if (!array_search($table_name, $cruds_created)) {
                    $cruds_filtered[$i] = $crud_table->$tables_in ?? '';
                    $cruds_filtered_columns[$table_name] = DB::select("SHOW COLUMNS FROM " . $table_name);
                }
            }
        }

        $data = [
            'crud' => $crud,
            'crud_campos' => $crud_campos,
            'cruds_availables' => $cruds_availables,
            'cruds_filtered' => $cruds_filtered,
            'cruds_filtered_columns' => $cruds_filtered_columns,
            'cruds_generated' => $cruds_generated,
            'options_crud' => $options_crud,
        ];

        return view('admin.crud.edit', $data);
    }


    /**
     * Update
     */
    public function update(Request $request)
    {
        Log::info('CrudController - update');
        Log::info($request);

        $validated = $request->validate([
            'nombre' => 'required',
            'alias_opcion' => 'required',
        ]);

        $request["estatus"] = (isset($request["estatus"]) ? 1 : 0);

        Log::info($request);
        try {
            $crud = $this->crudService->store($request->all());

            if ($crud) {

                $crudGenerado = $this->generadorCrudService->store($request->all());

                if ($crudGenerado) {
                    $message = 'Proceso completado. CRUD actualizado correctamente';

                    return redirect('/admin/crud')->with('message', $message);
                }
            }
        } catch (Exception $e) {
            return redirect('/admin/crud')->with('message-error', $e->getMessage());
        }
    }

    public function crudRefresh($crud_id)
    {
        Log::info('CrudController - crudRefresh');
        try {
            $crud = $this->generadorCrudService->crudRefresh($crud_id);

            if ($crud) {
                $message = 'Proceso completado. CRUD refrescado correctamente';

                return redirect('/admin/crud')->with('message', $message);
            }
            return redirect('/admin/crud')->with('message-error', 'Error');
        } catch (Exception $e) {
            return redirect('/admin/crud')->with('message-error', $e->getMessage());
        }
    }

    public function crudRefreshAll()
    {
        Log::info('CrudController - crudRefreshAll');
        try {
            $crud = $this->generadorCrudService->crudRefreshAll();

            if ($crud) {
                $message = 'Proceso completado. CRUDs refrescados correctamente';

                return redirect('/admin/crud')->with('message', $message);
            }
            return redirect('/admin/crud')->with('message-error', 'Error');
        } catch (Exception $e) {
            return redirect('/admin/crud')->with('message-error', $e->getMessage());
        }
    }
}
