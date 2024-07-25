<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Accesosdirectos69DataTable;
use App\Models\Accesosdirectos69;
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


                use App\Models\CrudsGenerados;
                



//%RELATION_DATATABLE_VARIABLES_USE%

class Accesosdirectos69Controller extends Controller
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
        Log::info('Accesosdirectos69Controller - __construct');
        Log::info('Accesosdirectos69Controller - request()->segment(2) -- '.request()->segment(2).' | request()->path() -- '.request()->path());
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

      if(isset($request["texto"]) ){
          $filters["texto"]=$request["texto"];
      }
      else{
          $request["texto"]="";
      }	

      
            if(isset($request["CrudsGenerados"]) ){
                $filters["CrudsGenerados"]=$request["CrudsGenerados"];
            }
            else{
                $request["CrudsGenerados"]="";
            }	    
        

      $documentos = $this->documentosService->getDocumentosByCrud('Accesosdirectos69');
      
      $dataTable = new Accesosdirectos69DataTable($filters, $documentos);

      $details = [  
        "texto" => $request["texto"],
        
            "CrudsGenerados" => $request["CrudsGenerados"],
        
            "CrudsGeneradosList" => CrudsGenerados::whereRaw("1 = 1")->get(),
        
      ];

        return $dataTable->render('cruds/Accesosdirectos69.list', $details);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        
                "CrudsGenerados" => CrudsGenerados::whereRaw("1 = 1")->get(), 
                
      ];
      
      return view('cruds/Accesosdirectos69.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Log::info('Accesosdirectos69Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{

        

        $Accesosdirectos69 = Accesosdirectos69::create($request->all());

        

        $message =  ' Acceso Directo: registro creado correctamente: ';

        $rutaCrud = '/admin/accesoDirecto';        

        return redirect( $rutaCrud)->with('message',$message);
      } catch (Exception $e) {
          Log::info('Accesosdirectos69Controller - store - Exception ' . $e->getMessage());

          $rutaCrud = '/admin/accesoDirecto';         

          return redirect( $rutaCrud)->with('message-error',$e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Accesosdirectos69 $Accesosdirectos69
     * @return \Illuminate\Http\Response
     */
    public function show( $Accesosdirectos69)
    {

      $idRegister = $Accesosdirectos69;
      $documentos = $this->documentosService->getDocumentosByCrud('Accesosdirectos69');

      //%RELATION_DATATABLE_VARIABLES%

        $data = [
          'documentos' => $documentos,
          'Accesosdirectos69' => Accesosdirectos69::find($Accesosdirectos69),
          
                "CrudsGenerados" => CrudsGenerados::whereRaw("1 = 1")->get(), 
                

          //%RELATION_DATATABLE_VARIABLES_DATA%
        ];
        return view('cruds/Accesosdirectos69.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Accesosdirectos69 $Accesosdirectos69
     * @return \Illuminate\Http\Response
     */
    public function edit($Accesosdirectos69)
    {
      $idRegister = $Accesosdirectos69;
      $documentos = $this->documentosService->getDocumentosByCrud('Accesosdirectos69');


      $data = [
        'documentos' => $documentos,

        'Accesosdirectos69' => Accesosdirectos69::find($Accesosdirectos69),
        
                "CrudsGenerados" => CrudsGenerados::whereRaw("1 = 1")->get(), 
                
      ];

      return view('cruds/Accesosdirectos69.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Accesosdirectos69 $Accesosdirectos69
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Accesosdirectos69)
    {
		//

    

    Log::info('Accesosdirectos69Controller - update');      

      Log::info($request);

      try{
        $Accesosdirectos69 = Accesosdirectos69::find($Accesosdirectos69);
      
        

      $Accesosdirectos69_updated = $Accesosdirectos69->update($request->all());
      
      

      $message =  ' Acceso Directo: registro actualizado correctamente: ';

      $rutaCrud = '/admin/accesoDirecto'; 

      return redirect($rutaCrud)->with('message',$message);
      
    } catch (Exception $e) {
        Log::info('Accesosdirectos69Controller - store - Exception ' . $e->getMessage());

        $rutaCrud = '/admin/accesoDirecto';  

        return redirect($rutaCrud)->with('message-error',$e->getMessage());
    }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Accesosdirectos69 $Accesosdirectos69
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $Accesosdirectos69)
    {
      Log::info('Accesosdirectos69Controller - destroy');
      Log::info($Accesosdirectos69);
       $Accesosdirectos69_delete = Accesosdirectos69::find($Accesosdirectos69);
      $Accesosdirectos69_delete = $Accesosdirectos69_delete->delete();       

      $message =  ' Acceso Directo: registro eliminado correctamente: ';

      $rutaCrud = '/admin/accesoDirecto';

      if( Session::has('Accesosdirectos69')){
        $rutaCrud = '/'.Session::get('Accesosdirectos69');
      }  

      return redirect($rutaCrud)->with('message',$message);	
    }
	
    public function getAccesosdirectos69DataTable(Request $request)
    {
      Log::info('Accesosdirectos69Controller - getAccesosdirectos69DataTable ');
      Log::info($request);
      $filters = $request->all();
      $documentos = $this->documentosService->getDocumentosByCrud('Accesosdirectos69');

       $dataTableAccesosdirectos69 = new Accesosdirectos69DataTable($filters, $documentos);
        return $dataTableAccesosdirectos69->render('cruds/Accesosdirectos69.datatable');
    }
	
}
