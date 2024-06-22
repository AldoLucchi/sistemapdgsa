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
    public function index(%OBJETO_DATATABLE% $dataTable)
    {			
		
        return $dataTable->render('cruds/%OBJETO_VIEW%.list');

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

        return redirect('/%MENU_RUTA%/%OBJETO_ROUTE%');
      } catch (Exception $e) {
          Log::info('%OBJETO_CONTROLLER% - store - Exception ' . $e->getMessage());

          return redirect('/');
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
        $data = [
          '%OBJETO_VARIABLE%' => %OBJETO%::find($%OBJETO_VARIABLE%),
          %TABLAS_ASOCIADAS%
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
    public function update(Request $request, %OBJETO% $%OBJETO_VARIABLE%)
    {
		//

    %FIELD_CHECKBOX%
    
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
	
		
	
}
