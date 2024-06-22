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
        return $dataTable->render('pages/apps.admin.crud.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages/apps.admin.crud.create');
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
     * Update
     */
    public function update(Request $request)
    {
        Log::info('CrudController - update');

        $request["estatus"] = (isset($request["estatus"]) ? 1 : 0);

        Log::info($request);
        try {
            $crud = $this->crudService->update($request->all(), $request['crud_id']);

            $message = 'Proceso completado. CRUD actualizado correctamente';

            return redirect('/admin/crud')->with('message', $message);
        } catch (Exception $e) {
            return redirect('/admin/crud')->with('message-error', $e->getMessage());
        }
    }
}
