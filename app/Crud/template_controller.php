<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\%OBJETO_DATATABLE%;
use App\Models\%OBJETO%;
use App\Services\FunctionsService;
use Exception;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
%TABLAS_ASOCIADAS_USE%

%SELECT_USE%

//%RELATION_DATATABLE_VARIABLES_USE%

class %OBJETO_CONTROLLER% extends Controller
{	
  private $functionsService;

  public function __construct(
      FunctionsService $functionsService
  ) {
      $this->functionsService = $functionsService;
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

        $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro creado correctamente: ';

        return redirect('/%MENU_RUTA%/%OBJETO_ROUTE%')->with('message',$message);
      } catch (Exception $e) {
          Log::info('%OBJETO_CONTROLLER% - store - Exception ' . $e->getMessage());

          return redirect('/%MENU_RUTA%/%OBJETO_VARIABLE%')->with('message-error',$e->getMessage());
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

      $%OBJETO_VARIABLE% = $%OBJETO_VARIABLE%->update($request->all());

      $message =  ' %OBJETO_LABEL_INDIVIDUAL%: registro actualizado correctamente: ';

      return redirect('/%MENU_RUTA%/%OBJETO_VARIABLE%')->with('message',$message);
      
    } catch (Exception $e) {
        Log::info('%OBJETO_CONTROLLER% - store - Exception ' . $e->getMessage());

        return redirect('/%MENU_RUTA%/%OBJETO_VARIABLE%')->with('message-error',$e->getMessage());
    }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  %OBJETO% $%OBJETO_VARIABLE%
     * @return \Illuminate\Http\Response
     */
    public function destroy(%OBJETO% $%OBJETO_VARIABLE%)
    {
		//
    }
	
    public function get%OBJETO%(%OBJETO_DATATABLE% $dataTable)
    {
        return $dataTable->render('cruds/%OBJETO%.datatable');
    }
	
}
