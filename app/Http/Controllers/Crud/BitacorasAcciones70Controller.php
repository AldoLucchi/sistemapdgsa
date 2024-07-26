<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\BitacorasAcciones70DataTable;
use App\Models\BitacorasAcciones70;
use App\Services\EtiquetaDocumentoService;
use App\Services\FunctionsService;
use App\Services\DocumentoService;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;





//%RELATION_DATATABLE_VARIABLES_USE%

class BitacorasAcciones70Controller extends Controller
{	
  protected $functionsService;
  protected $etiquetasDocumentosService;
  protected $documentosService;

  public function __construct(
      FunctionsService $functionsService,
      EtiquetaDocumentoService $etiquetasDocumentosService,
      DocumentoService $documentosService
  ) {
      $this->functionsService = $functionsService;
      $this->etiquetasDocumentosService = $etiquetasDocumentosService;
      $this->documentosService = $documentosService;

      if( request()->segment(2)  ){
        Log::info('BitacorasAcciones70Controller - __construct');
        Log::info('BitacorasAcciones70Controller - request()->segment(2) -- '.request()->segment(2).' | request()->path() -- '.request()->path());
        Session::put(request()->segment(2),  request()->path());

        Session::put('crud_active', request()->segment(2));
        Session::put('current_crud', request()->segment(2));
        Session::put('crud_active_id', request()->segment(3));
        Log::info('BitacorasAcciones70Controller - crud_active -- '.Session::get('crud_active').' | crud_active_id -- '. Session::get('crud_active_id'));
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

      if(isset($request["texto"]) ){
          $filters["texto"]=$request["texto"];
      }
      else{
          $request["texto"]="";
      }	

      

      $documentos = $this->documentosService->getDocumentosByCrud('BitacorasAcciones70');
      
      $dataTable = new BitacorasAcciones70DataTable($filters, $documentos);

      $details = [  
        "texto" => $request["texto"],
        
      ];

        return $dataTable->render('cruds/BitacorasAcciones70.list', $details);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        
      ];
      
      return view('cruds/BitacorasAcciones70.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Log::info('BitacorasAcciones70Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{

        

        $BitacorasAcciones70 = BitacorasAcciones70::create($request->all());

        

        $message =  ' Bitácora Acción: registro creado correctamente: ';

        $rutaCrud = '/admin/bitacoraAccion';
         

        return redirect( $rutaCrud)->with('message',$message);
      } catch (Exception $e) {
          Log::info('BitacorasAcciones70Controller - store - Exception ' . $e->getMessage());

          $rutaCrud = '/admin/bitacoraAccion';

          return redirect( $rutaCrud)->with('message-error',$e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  BitacorasAcciones70 $BitacorasAcciones70
     * @return \Illuminate\Http\Response
     */
    public function show( $BitacorasAcciones70)
    {

      $idRegister = $BitacorasAcciones70;
      $documentos = $this->documentosService->getDocumentosByCrud('BitacorasAcciones70');

      //%RELATION_DATATABLE_VARIABLES%

        $data = [
          'documentos' => $documentos,
          'BitacorasAcciones70' => BitacorasAcciones70::find($BitacorasAcciones70),
          

          //%RELATION_DATATABLE_VARIABLES_DATA%
        ];
        return view('cruds/BitacorasAcciones70.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BitacorasAcciones70 $BitacorasAcciones70
     * @return \Illuminate\Http\Response
     */
    public function edit($BitacorasAcciones70)
    {
      $idRegister = $BitacorasAcciones70;
      $documentos = $this->documentosService->getDocumentosByCrud('BitacorasAcciones70');


      $data = [
        'documentos' => $documentos,

        'BitacorasAcciones70' => BitacorasAcciones70::find($BitacorasAcciones70),
        
      ];

      return view('cruds/BitacorasAcciones70.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  BitacorasAcciones70 $BitacorasAcciones70
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $BitacorasAcciones70)
    {
		//

    

    Log::info('BitacorasAcciones70Controller - update');      

      Log::info($request);

      try{
        $BitacorasAcciones70 = BitacorasAcciones70::find($BitacorasAcciones70);
      
        

      $BitacorasAcciones70_updated = $BitacorasAcciones70->update($request->all());
      
      

      $message =  ' Bitácora Acción: registro actualizado correctamente: ';

      $rutaCrud = '/admin/bitacoraAccion';      

      return redirect($rutaCrud)->with('message',$message);
      
    } catch (Exception $e) {
        Log::info('BitacorasAcciones70Controller - store - Exception ' . $e->getMessage());

        $rutaCrud = '/admin/bitacoraAccion';
         

        return redirect($rutaCrud)->with('message-error',$e->getMessage());
    }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  BitacorasAcciones70 $BitacorasAcciones70
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $BitacorasAcciones70)
    {
      Log::info('BitacorasAcciones70Controller - destroy');
      Log::info($BitacorasAcciones70);
       $BitacorasAcciones70_delete = BitacorasAcciones70::find($BitacorasAcciones70);
      $BitacorasAcciones70_delete = $BitacorasAcciones70_delete->delete();       

      $message =  ' Bitácora Acción: registro eliminado correctamente: ';

      $rutaCrud = '/admin/bitacoraAccion';     

      return redirect($rutaCrud)->with('message',$message);	
    }
	
    public function getBitacorasAcciones70DataTable(Request $request)
    {
      Log::info('BitacorasAcciones70Controller - getBitacorasAcciones70DataTable ');
      Log::info($request);
      $filters = $request->all();
      $documentos = $this->documentosService->getDocumentosByCrud('BitacorasAcciones70');

       $dataTableBitacorasAcciones70 = new BitacorasAcciones70DataTable($filters, $documentos);
        return $dataTableBitacorasAcciones70->render('cruds/BitacorasAcciones70.datatable');
    }
	
}
