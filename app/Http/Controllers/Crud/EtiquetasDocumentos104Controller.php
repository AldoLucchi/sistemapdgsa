<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\EtiquetasDocumentos104DataTable;
use App\Models\EtiquetasDocumentos104;
use App\Services\EtiquetaDocumentoService;
use App\Services\FunctionsService;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;




//%RELATION_DATATABLE_VARIABLES_USE%

class EtiquetasDocumentos104Controller extends Controller
{
  private $functionsService;
  private $etiquetaDocumentoService;

  public function __construct(
    FunctionsService $functionsService,
    EtiquetaDocumentoService $etiquetaDocumentoService
  ) {
    $this->functionsService = $functionsService;
    $this->etiquetaDocumentoService = $etiquetaDocumentoService; 

    if( request()->segments(1)  ){
      Session::put(request()->segments(1),  request()->path());
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



    $dataTable = new EtiquetasDocumentos104DataTable($filters);

    $details = [
      "texto" => $request["texto"],

    ];

    return $dataTable->render('cruds/EtiquetasDocumentos104.list', $details);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $data = [];

    return view('cruds/EtiquetasDocumentos104.create', $data);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    Log::info('EtiquetasDocumentos104Controller - store');
    Log::info($request);

    $validated = $request->validate([
      //'name' => 'required',
    ]);



    try {



      $EtiquetasDocumentos104 = EtiquetasDocumentos104::create($request->all());

      $message =  ' Etiqueta Documento: registro creado correctamente: ';

      $rutaCrud = '/admin/etiquetaDocumento';

      if( Session::has('etiquetaDocumento')){
        $rutaCrud = '/'.Session::get('etiquetaDocumento');
      }

      return redirect($rutaCrud )->with('message', $message);
    } catch (Exception $e) {
      Log::info('EtiquetasDocumentos104Controller - store - Exception ' . $e->getMessage());

      return redirect($rutaCrud )->with('message-error', $e->getMessage());
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  EtiquetasDocumentos104 $EtiquetasDocumentos104
   * @return \Illuminate\Http\Response
   */
  public function show($EtiquetasDocumentos104)
  {


    //%RELATION_DATATABLE_VARIABLES%

    $data = [
      'EtiquetasDocumentos104' => EtiquetasDocumentos104::find($EtiquetasDocumentos104),


      //%RELATION_DATATABLE_VARIABLES_DATA%
    ];
    return view('cruds/EtiquetasDocumentos104.show', $data);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  EtiquetasDocumentos104 $EtiquetasDocumentos104
   * @return \Illuminate\Http\Response
   */
  public function edit($EtiquetasDocumentos104)
  {
    $data = [
      'EtiquetasDocumentos104' => EtiquetasDocumentos104::find($EtiquetasDocumentos104),

    ];

    return view('cruds/EtiquetasDocumentos104.edit', $data);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  EtiquetasDocumentos104 $EtiquetasDocumentos104
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $EtiquetasDocumentos104)
  {
    //



    Log::info('EtiquetasDocumentos104Controller - update');

    Log::info($request);

    try {
      $EtiquetasDocumentos104 = EtiquetasDocumentos104::find($EtiquetasDocumentos104);



      $EtiquetasDocumentos104 = $EtiquetasDocumentos104->update($request->all());

      $message =  ' Etiqueta Documento: registro actualizado correctamente: ';

      return redirect('/admin/etiquetaDocumento')->with('message', $message);
    } catch (Exception $e) {
      Log::info('EtiquetasDocumentos104Controller - store - Exception ' . $e->getMessage());

      return redirect('/admin/etiquetaDocumento')->with('message-error', $e->getMessage());
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  EtiquetasDocumentos104 $EtiquetasDocumentos104
   * @return \Illuminate\Http\Response
   */
  public function destroy(EtiquetasDocumentos104 $EtiquetasDocumentos104)
  {
    //
  }

  public function getEtiquetasDocumentos104DataTable(EtiquetasDocumentos104DataTable $dataTableEtiquetasDocumentos104)
  {
    return $dataTableEtiquetasDocumentos104->render('cruds/EtiquetasDocumentos104.datatable');
  }

  public function getEtiquetaDocumento($alias, $id)
  {
    return $this->etiquetaDocumentoService->getValueAlias($alias, $id);
  }
}
