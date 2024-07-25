<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Documentos61DataTable;
use App\Models\Documentos61;
use App\Services\EtiquetaDocumentoService;
use App\Services\FunctionsService;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;


use App\Models\EtiquetasDocumentos104;
use Illuminate\Support\Facades\DB;

//%RELATION_DATATABLE_VARIABLES_USE%

class Documentos61Controller extends Controller
{
  private $functionsService;
  private $etiquetasDocumentosService;

  public function __construct(
    FunctionsService $functionsService,
    EtiquetaDocumentoService $etiquetasDocumentosService
  ) {
    $this->functionsService = $functionsService;
    $this->etiquetasDocumentosService = $etiquetasDocumentosService;

    if (request()->segment(2)) {
      Log::info('Documentos61Controller - __construct');
      Log::info('request()->segment(2) -- ' . request()->segment(2) . ' | request()->path() -- ' . request()->path());
      Session::put(request()->segment(2),  request()->path());
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    $filters = [];

    if (isset($request["texto"])) {
      $filters["texto"] = $request["texto"];
    } else {
      $request["texto"] = "";
    }



    $dataTable = new Documentos61DataTable($filters);

    $details = [
      "texto" => $request["texto"],

    ];

    return $dataTable->render('cruds/Documentos61.list', $details);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {

    $data = [
      "tablesDatabase" => $this->getTablesDatabase(),
      "etiquetasDocumentos" => EtiquetasDocumentos104::orderBy("alias", "ASC")->get(),
    ];

    return view('cruds/Documentos61.create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Log::info('Documentos61Controller - store');
    Log::info($request);

    $validated = $request->validate([
      //'name' => 'required',
    ]);

    try {

      $Documentos61 = Documentos61::create($request->all());

      $message =  ' Documento: registro creado correctamente: ';

      $rutaCrud = '/admin/documento';

      if (Session::has('Documentos61')) {
        $rutaCrud = '/' . Session::get('Documentos61');
      }

      return redirect($rutaCrud)->with('message', $message);
    } catch (Exception $e) {
      Log::info('Documentos61Controller - store - Exception ' . $e->getMessage());

      $rutaCrud = '/admin/documento';

      if (Session::has('Documentos61')) {
        $rutaCrud = '/' . Session::get('Documentos61');
      }

      return redirect($rutaCrud)->with('message-error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  Documentos61 $Documentos61
   * @return \Illuminate\Http\Response
   */
  public function show($Documentos61)
  {

    $idRegister = $Documentos61;

    //%RELATION_DATATABLE_VARIABLES%


    $data = [
      "tablesDatabase" => $this->getTablesDatabase(),
      'Documentos61' => Documentos61::find($Documentos61),
      "etiquetasDocumentos" => EtiquetasDocumentos104::orderBy("alias", "ASC")->get(),


      //%RELATION_DATATABLE_VARIABLES_DATA%
    ];
    return view('cruds/Documentos61.show', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  Documentos61 $Documentos61
   * @return \Illuminate\Http\Response
   */
  public function edit($Documentos61)
  {
    $idRegister = $Documentos61;

    $data = [
      "tablesDatabase" => $this->getTablesDatabase(),
      'Documentos61' => Documentos61::find($Documentos61),
      "etiquetasDocumentos" => EtiquetasDocumentos104::orderBy("alias", "ASC")->get(),

    ];

    return view('cruds/Documentos61.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  Documentos61 $Documentos61
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $Documentos61)
  {
    //

    Log::info('Documentos61Controller - update');

    Log::info($request);

    try {
      $Documentos61 = Documentos61::find($Documentos61);

      $Documentos61_updated = $Documentos61->update($request->all());

      $message =  ' Documento: registro actualizado correctamente: ';

      $rutaCrud = '/admin/documento';

      if (Session::has('Documentos61')) {
        $rutaCrud = '/' . Session::get('Documentos61');
      }

      return redirect($rutaCrud)->with('message', $message);
    } catch (Exception $e) {
      Log::info('Documentos61Controller - store - Exception ' . $e->getMessage());

      $rutaCrud = '/admin/documento';

      if (Session::has('Documentos61')) {
        $rutaCrud = '/' . Session::get('Documentos61');
      }

      return redirect($rutaCrud)->with('message-error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  Documentos61 $Documentos61
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $Documentos61)
  {
    Log::info('Documentos61Controller - destroy');
    Log::info($Documentos61);
    $Documentos61_delete = Documentos61::find($Documentos61);
    $Documentos61_delete = $Documentos61_delete->delete();

    $message =  ' Documento: registro eliminado correctamente: ';

    $rutaCrud = '/admin/documento';

    if (Session::has('Documentos61')) {
      $rutaCrud = '/' . Session::get('Documentos61');
    }

    return redirect($rutaCrud)->with('message', $message);
  }

  public function getDocumentos61DataTable(Request $request)
  {
    Log::info('Documentos61Controller - getDocumentos61DataTable ');
    Log::info($request);
    $filters = $request->all();
    $dataTableDocumentos61 = new Documentos61DataTable($filters);
    return $dataTableDocumentos61->render('cruds/Documentos61.datatable');
  }

  protected function getTablesDatabase()
  {
    $tables_excluded_env = env('CRUD_TABLES_EXCLUDED');
    $tables_excluded = explode(',', $tables_excluded_env);

    $tables = DB::select('SHOW TABLES');
    $tables_in = 'Tables_in_' . env('DB_DATABASE');
    $tables_database = [];

    foreach ($tables as $i => $crud_table) {
      if (!in_array($crud_table->$tables_in, $tables_excluded)) {
        $tables_database[] = $crud_table->$tables_in;
      }
    }

    return $tables_database;
  }

  public function generarPdf($idRegister, $idDocumento)
  {
    $Documentos61 = Documentos61::find($idDocumento);
    $html = $Documentos61->documento;
    $html = $this->etiquetasDocumentosService->replaceVariables($html, $idRegister);
    $pdf = App::make("dompdf.wrapper");
    Log::info($html);
    $pdf->loadHTML($html);
    //$pdf->save(public_path() . "/docs/Documentos61_" . $Documentos61->iddocumento . ".pdf");

    return $pdf->stream();
  }
}
