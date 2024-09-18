<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\%OBJETO_DATATABLE%;
use App\Models\%OBJETO%;

use App\Services\EtiquetaDocumentoService;
use App\Services\FunctionsService;
use App\Services\DocumentoService;
use App\Services\BitacoraService;
use App\Services\Crud\%OBJETO_SERVICE%;

use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Exception;


%SELECT_USE%

//%RELATION_DATATABLE_VARIABLES_USE%

class %OBJETO_CONTROLLER% extends Controller
{	
  protected $functionsService;
  protected $etiquetasDocumentosService;
  protected $documentosService;
  protected $bitacoraService;
  protected $%OBJETO_SERVICE%;

  public function __construct(
      %OBJETO_SERVICE% $%OBJETO_SERVICE%,
      FunctionsService $functionsService,
      EtiquetaDocumentoService $etiquetasDocumentosService,
      DocumentoService $documentosService,
      BitacoraService $bitacoraService
  ) {
      $this->%OBJETO_SERVICE% = $%OBJETO_SERVICE%;
      $this->functionsService = $functionsService;
      $this->etiquetasDocumentosService = $etiquetasDocumentosService;
      $this->documentosService = $documentosService;
      $this->bitacoraService = $bitacoraService;

      if( request()->segment(2)  ){
        Log::info('%OBJETO_CONTROLLER% - __construct');
        Log::info('%OBJETO_CONTROLLER% - request()->segment(2) -- '.request()->segment(2).' | request()->path() -- '.request()->path());
        Session::put(request()->segment(2),  request()->path());

        Session::put('crud_active', request()->segment(2));
        Session::put('current_crud', request()->segment(2));
        Session::put('crud_active_id', request()->segment(3));
        Log::info('%OBJETO_CONTROLLER% - crud_active -- '.Session::get('crud_active').' | crud_active_id -- '. Session::get('crud_active_id'));
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

      %FILTERS_CONTROLLER_INDEX%

      $documentos = $this->documentosService->getDocumentosByCrud('%OBJETO%');
      
      $dataTable = new %OBJETO_DATATABLE%($filters, $documentos);

      %FILTERS_VARIABLES_GET%

      $row_url_custom = '%OBJETO_ROW_URL_CUSTOM%';

      $details = [  
        "texto" => $request["texto"],
        "row_url_custom" => $row_url_custom ,        
        %FILTERS_VARIABLES%
      ];

      $sysdate = date('Y-m-d H:i:s');

      $data = [
        'crud' => '%OBJETO%',
        'tabla' => '%OBJETO_TABLE%',
        'idaccion' => 5,
        'descripcion' => 'Visita %OBJETO%',
        'ip' =>  $this->getIP(),
        'fecha' => $sysdate,
        'idusuario'=> (Session::has('idusuario')?Session::get('idusuario'):0),
      ];
  
      $this->bitacoraService->insertBitacora($data);      

        return $dataTable->render('cruds/%OBJETO_VIEW%.list', $details);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }

      %OBJETO_CONTROLLER_CREATE%

      $data = $this->%OBJETO_SERVICE%->getData();

      %CONTROLLER_VARIABLES_ANIDADOS%
      
      return view('cruds/%OBJETO_VIEW%.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Log::info('%OBJETO_CONTROLLER% - store');
      Log::info($request);

      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }  

      %OBJETO_CONTROLLER_CREATE%

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      %FIELD_CHECKBOX%

      try{

        %FIELD_FILE_STORAGE%

        $%OBJETO_VARIABLE% = %OBJETO%::create($request->all());

        $request['%FIELD_ID%'] = $%OBJETO_VARIABLE%->%FIELD_ID% ;
        $request['idfield'] = '%FIELD_ID%';

        $this->insertAnidados($request->all());

        %FIELD_PDF%

        $message_ruta_create = str_replace('create','',url()->current());
        $message_ruta = $message_ruta_create.'/'.$%OBJETO_VARIABLE%->%FIELD_ID%.'/edit'; //'/%OBJETO_VARIABLE%/'.$%OBJETO_VARIABLE%->%FIELD_ID%.'/edit';

        if(isset($request['redirect_url']) && $request['redirect_url']){
          $rutaCrud = $request['redirect_url'];
          $message_ruta .='?redirect_url='.$rutaCrud;
        }

        $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro creado correctamente: <a href="'.$message_ruta.'" class="text-white">'.$%OBJETO_VARIABLE%->%FIELD_ID%.'</a>';

        return redirect( $rutaCrud)->with('message',$message);
      } catch (Exception $e) {
          Log::info('%OBJETO_CONTROLLER% - store - Exception ' . $e->getMessage());

          $rutaCrud = '/crud/%OBJETO_ROUTE%';

          if( Session::has('%OBJETO_ROUTE%')){
            $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
          } 

          return redirect( $rutaCrud)->with('message-error',$e->getMessage());
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  %OBJETO% $%OBJETO_VARIABLE%
     * @return \Illuminate\Http\Response
     */
    public function show( $%OBJETO_VARIABLE%)
    {
      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }

      %OBJETO_CONTROLLER_READ%

      $idRegister = $%OBJETO_VARIABLE%;
      $documentos = $this->documentosService->getDocumentosByCrud('%OBJETO%');


      //%RELATION_DATATABLE_VARIABLES%

        $data1 = [
          'documentos' => $documentos,
          '%OBJETO_VARIABLE%' => %OBJETO%::find($%OBJETO_VARIABLE%),

          //%RELATION_DATATABLE_VARIABLES_DATA%
        ];

        $data2 = $this->%OBJETO_SERVICE%->getData();

        $data = array_merge($data1, $data2);

        return view('cruds/%OBJETO_VIEW%.show', $data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  %OBJETO% $%OBJETO_VARIABLE%
     * @return \Illuminate\Http\Response
     */
    public function edit($%OBJETO_VARIABLE%)
    {
      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }
      
      %OBJETO_CONTROLLER_UPDATE%

      $idRegister = $%OBJETO_VARIABLE%;
      $documentos = $this->documentosService->getDocumentosByCrud('%OBJETO%');

      //%RELATION_DATATABLE_VARIABLES%

      $data1 = [
        'documentos' => $documentos,

        '%OBJETO_VARIABLE%' => %OBJETO%::find($%OBJETO_VARIABLE%),

        //%RELATION_DATATABLE_VARIABLES_DATA%
      ];

      $data2 = $this->%OBJETO_SERVICE%->getData();

      $data = array_merge($data1, $data2);

      return view('cruds/%OBJETO_VIEW%.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  %OBJETO% $%OBJETO_VARIABLE%
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $%OBJETO_VARIABLE%)
    {
      $id = $%OBJETO_VARIABLE%;

      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }  

      if(isset($request['guardar_permanecer']) && $request['guardar_permanecer']){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%').'/'. $id.'/edit/';
      }

      %OBJETO_CONTROLLER_UPDATE%

      %FIELD_CHECKBOX%

      Log::info('%OBJETO_CONTROLLER% - update');      

      Log::info($request);

      try{
        $%OBJETO_VARIABLE% = %OBJETO_VARIABLE%::find($%OBJETO_VARIABLE%);
      
        %FIELD_FILE_STORAGE%

        $%OBJETO_VARIABLE%_updated = $%OBJETO_VARIABLE%->update($request->all());
      
        %FIELD_PDF%

        $message_ruta = url()->current(); //'/%OBJETO_VARIABLE%/'.$id.'/edit';

        if(isset($request['redirect_url']) && $request['redirect_url']){
          $rutaCrud = $request['redirect_url'];
          $message_ruta  .= '/edit?redirect_url='.$rutaCrud;
        }

        $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro actualizado correctamente: <a href="'.$message_ruta .'" class="text-white">'.$id.'</a>';    

        return redirect($rutaCrud)->with('message',$message);
      
    } catch (Exception $e) {
        Log::info('%OBJETO_CONTROLLER% - store - Exception ' . $e->getMessage());

        $rutaCrud = '/crud/%OBJETO_ROUTE%';

        if( Session::has('%OBJETO_ROUTE%')){
          $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
        }    

        return redirect($rutaCrud)->with('message-error',$e->getMessage());
    }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  %OBJETO% $%OBJETO_VARIABLE%
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $%OBJETO_VARIABLE%)
    {
      Log::info('%OBJETO_CONTROLLER% - destroy');
      Log::info($%OBJETO_VARIABLE%);

      $id = $%OBJETO_VARIABLE%;

      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }

      %OBJETO_CONTROLLER_DELETE%

       $%OBJETO_VARIABLE%_delete = %OBJETO_VARIABLE%::find($%OBJETO_VARIABLE%);
      $%OBJETO_VARIABLE%_delete = $%OBJETO_VARIABLE%_delete->delete();       

      $message_ruta = url()->current(); //'/%OBJETO_VARIABLE%/'.$id.'/edit';
      $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro eliminado correctamente: <a href="'.$message_ruta.'" class="text-white">'.$id.'</a>';        

      return redirect($rutaCrud)->with('message',$message);	
    }
	
    public function get%OBJETO_DATATABLE%(Request $request)
    {
      Log::info('%OBJETO_CONTROLLER% - get%OBJETO_DATATABLE% ');
      Log::info($request);
      $filters = $request->all();
      $documentos = $this->documentosService->getDocumentosByCrud('%OBJETO%');

       $dataTable%OBJETO% = new %OBJETO_DATATABLE%($filters, $documentos);
        return $dataTable%OBJETO%->render('cruds/%OBJETO%.datatable');
    }

    public function insertAnidados($request)
    {
      Log::info('%OBJETO_CONTROLLER% - insertAnidados');

      %CONTROLLER_INSERT_ANIDADOS%
    }
	
}
