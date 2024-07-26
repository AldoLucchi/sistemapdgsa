<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Bitacora71DataTable;
use App\Models\Bitacora71;
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
                
                use App\Models\BitacorasAcciones;
                
                use App\Models\Proyectos;
                
                use App\Models\Clientes;
                



//%RELATION_DATATABLE_VARIABLES_USE%

class Bitacora71Controller extends Controller
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
        Log::info('Bitacora71Controller - __construct');
        Log::info('Bitacora71Controller - request()->segment(2) -- '.request()->segment(2).' | request()->path() -- '.request()->path());
        Session::put(request()->segment(2),  request()->path());

        Session::put('crud_active', request()->segment(2));
        Session::put('current_crud', request()->segment(2));
        Session::put('crud_active_id', request()->segment(3));
        Log::info('Bitacora71Controller - crud_active -- '.Session::get('crud_active').' | crud_active_id -- '. Session::get('crud_active_id'));
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
        
            if(isset($request["BitacorasAcciones"]) ){
                $filters["BitacorasAcciones"]=$request["BitacorasAcciones"];
            }
            else{
                $request["BitacorasAcciones"]="";
            }	    
        
            if(isset($request["Proyectos"]) ){
                $filters["Proyectos"]=$request["Proyectos"];
            }
            else{
                $request["Proyectos"]="";
            }	    
        
            if(isset($request["Clientes"]) ){
                $filters["Clientes"]=$request["Clientes"];
            }
            else{
                $request["Clientes"]="";
            }	    
        
            if(isset($request["fecha_from"]) ){
                $filters["fecha_from"]=$request["fecha_from"];
            }
            else{
                $request["fecha_from"]="";
            }	    
        
            if(isset($request["fecha_to"]) ){
                $filters["fecha_to"]=$request["fecha_to"];
            }
            else{
                $request["fecha_to"]="";
            }	    
        

      $documentos = $this->documentosService->getDocumentosByCrud('Bitacora71');
      
      $dataTable = new Bitacora71DataTable($filters, $documentos);

      $details = [  
        "texto" => $request["texto"],
        
            "CrudsGenerados" => $request["CrudsGenerados"],
        
            "CrudsGeneradosList" => CrudsGenerados::whereRaw("1 = 1")->get(),
        
            "BitacorasAcciones" => $request["BitacorasAcciones"],
        
            "BitacorasAccionesList" => BitacorasAcciones::whereRaw("1 = 1")->get(),
        
            "Proyectos" => $request["Proyectos"],
        
            "ProyectosList" => Proyectos::whereRaw("1 = 1")->get(),
        
            "Clientes" => $request["Clientes"],
        
            "ClientesList" => Clientes::whereRaw("1 = 1")->get(),
        
            "fecha_from" => $request["fecha_from"],
        
            "fecha_to" => $request["fecha_to"],
        
      ];

        return $dataTable->render('cruds/Bitacora71.list', $details);

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
                
                "BitacorasAcciones" => BitacorasAcciones::whereRaw("1 = 1")->get(), 
                
                "Proyectos" => Proyectos::whereRaw("1 = 1")->get(), 
                
                "Clientes" => Clientes::whereRaw("1 = 1")->get(), 
                
      ];
      
      return view('cruds/Bitacora71.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Log::info('Bitacora71Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{

        

        $Bitacora71 = Bitacora71::create($request->all());

        

        $message =  ' Bitácora: registro creado correctamente: ';

        $rutaCrud = '/admin/bitacora';

        return redirect( $rutaCrud)->with('message',$message);
      } catch (Exception $e) {
          Log::info('Bitacora71Controller - store - Exception ' . $e->getMessage());

          $rutaCrud = '/admin/bitacora';

          return redirect( $rutaCrud)->with('message-error',$e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Bitacora71 $Bitacora71
     * @return \Illuminate\Http\Response
     */
    public function show( $Bitacora71)
    {

      $idRegister = $Bitacora71;
      $documentos = $this->documentosService->getDocumentosByCrud('Bitacora71');

      //%RELATION_DATATABLE_VARIABLES%

        $data = [
          'documentos' => $documentos,
          'Bitacora71' => Bitacora71::find($Bitacora71),
          
                "CrudsGenerados" => CrudsGenerados::whereRaw("1 = 1")->get(), 
                
                "BitacorasAcciones" => BitacorasAcciones::whereRaw("1 = 1")->get(), 
                
                "Proyectos" => Proyectos::whereRaw("1 = 1")->get(), 
                
                "Clientes" => Clientes::whereRaw("1 = 1")->get(), 
                

          //%RELATION_DATATABLE_VARIABLES_DATA%
        ];
        return view('cruds/Bitacora71.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Bitacora71 $Bitacora71
     * @return \Illuminate\Http\Response
     */
    public function edit($Bitacora71)
    {
      $idRegister = $Bitacora71;
      $documentos = $this->documentosService->getDocumentosByCrud('Bitacora71');


      $data = [
        'documentos' => $documentos,

        'Bitacora71' => Bitacora71::find($Bitacora71),
        
                "CrudsGenerados" => CrudsGenerados::whereRaw("1 = 1")->get(), 
                
                "BitacorasAcciones" => BitacorasAcciones::whereRaw("1 = 1")->get(), 
                
                "Proyectos" => Proyectos::whereRaw("1 = 1")->get(), 
                
                "Clientes" => Clientes::whereRaw("1 = 1")->get(), 
                
      ];

      return view('cruds/Bitacora71.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Bitacora71 $Bitacora71
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Bitacora71)
    {
		//

    

    Log::info('Bitacora71Controller - update');      

      Log::info($request);

      try{
        $Bitacora71 = Bitacora71::find($Bitacora71);
      
        

      $Bitacora71_updated = $Bitacora71->update($request->all());
      
      

      $message =  ' Bitácora: registro actualizado correctamente: ';

      $rutaCrud = '/admin/bitacora';

      return redirect($rutaCrud)->with('message',$message);
      
    } catch (Exception $e) {
        Log::info('Bitacora71Controller - store - Exception ' . $e->getMessage());

        $rutaCrud = '/admin/bitacora';

        return redirect($rutaCrud)->with('message-error',$e->getMessage());
    }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Bitacora71 $Bitacora71
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $Bitacora71)
    {
      Log::info('Bitacora71Controller - destroy');
      Log::info($Bitacora71);
       $Bitacora71_delete = Bitacora71::find($Bitacora71);
      $Bitacora71_delete = $Bitacora71_delete->delete();       

      $message =  ' Bitácora: registro eliminado correctamente: ';

      $rutaCrud = '/admin/bitacora';

      return redirect($rutaCrud)->with('message',$message);	
    }
	
    public function getBitacora71DataTable(Request $request)
    {
      Log::info('Bitacora71Controller - getBitacora71DataTable ');
      Log::info($request);
      $filters = $request->all();
      $documentos = $this->documentosService->getDocumentosByCrud('Bitacora71');

       $dataTableBitacora71 = new Bitacora71DataTable($filters, $documentos);
        return $dataTableBitacora71->render('cruds/Bitacora71.datatable');
    }
	
}
