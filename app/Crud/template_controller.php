<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\%OBJETO_DATATABLE%;
use App\Models\%OBJETO%;
use App\Services\EtiquetaDocumentoService;
use App\Services\FunctionsService;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

%TABLAS_ASOCIADAS_USE%

%SELECT_USE%

//%RELATION_DATATABLE_VARIABLES_USE%

class %OBJETO_CONTROLLER% extends Controller
{	
  private $functionsService;
  private $etiquetasDocumentosService;

  public function __construct(
      FunctionsService $functionsService,
      EtiquetaDocumentoService $etiquetasDocumentosService
  ) {
      $this->functionsService = $functionsService;
      $this->etiquetasDocumentosService = $etiquetasDocumentosService;

      if( request()->segment(2)  ){
        Log::info('%OBJETO_CONTROLLER% - __construct');
        Log::info('request()->segment(2) -- '.request()->segment(2).' | request()->path() -- '.request()->path());
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

      %FILTERS%
      
      $dataTable = new %OBJETO_DATATABLE%($filters);

      $details = [  
        "texto" => $request["texto"],
        %FILTERS_VARIABLES%
      ];

        return $dataTable->render('cruds/%OBJETO_VIEW%.list', $details);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        %TABLAS_ASOCIADAS%
      ];
      
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

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      %FIELD_CHECKBOX%

      try{

        %FIELD_FILE_STORAGE%

        $%OBJETO_VARIABLE% = %OBJETO%::create($request->all());

        %FIELD_PDF%

        $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro creado correctamente: ';

        $rutaCrud = '/crud/%OBJETO_ROUTE%';

        if( Session::has('%OBJETO_ROUTE%')){
          $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
        }  

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


      //%RELATION_DATATABLE_VARIABLES%

        $data = [
          '%OBJETO_VARIABLE%' => %OBJETO%::find($%OBJETO_VARIABLE%),
          %TABLAS_ASOCIADAS%

          //%RELATION_DATATABLE_VARIABLES_DATA%
        ];
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
      $data = [
        '%OBJETO_VARIABLE%' => %OBJETO%::find($%OBJETO_VARIABLE%),
        %TABLAS_ASOCIADAS%
      ];

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
		//

    %FIELD_CHECKBOX%

    Log::info('%OBJETO_CONTROLLER% - update');      

      Log::info($request);

      try{
        $%OBJETO_VARIABLE% = %OBJETO_VARIABLE%::find($%OBJETO_VARIABLE%);
      
        %FIELD_FILE_STORAGE%

      $%OBJETO_VARIABLE%_updated = $%OBJETO_VARIABLE%->update($request->all());
      
      %FIELD_PDF%

      $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro actualizado correctamente: ';

      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }  

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
       $%OBJETO_VARIABLE%_delete = %OBJETO_VARIABLE%::find($%OBJETO_VARIABLE%);
      $%OBJETO_VARIABLE%_delete = $%OBJETO_VARIABLE%_delete->delete();       

      $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro eliminado correctamente: ';

      $rutaCrud = '/crud/%OBJETO_ROUTE%';

      if( Session::has('%OBJETO_ROUTE%')){
        $rutaCrud = '/'.Session::get('%OBJETO_ROUTE%');
      }  

      return redirect($rutaCrud)->with('message',$message);	
    }
	
    public function get%OBJETO_DATATABLE%(%OBJETO_DATATABLE% $dataTable%OBJETO%)
    {
        return $dataTable%OBJETO%->render('cruds/%OBJETO%.datatable');
    }
	
}
