<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\OpcionesMenues99DataTable;
use App\Models\OpcionesMenues99;
use Exception;
use Illuminate\Support\Facades\Log;



class OpcionesMenues99Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(OpcionesMenues99DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/OpcionesMenues99.list');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      Log::info('OpcionesMenues99Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                

      try{
        $OpcionesMenues99 = OpcionesMenues99::create($request->all());

        return redirect('/crud/OpcionesMenues99');
      } catch (Exception $e) {
          Log::info('OpcionesMenues99Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  OpcionesMenues99 $OpcionesMenues99
     * @return \Illuminate\Http\Response
     */
    public function show( $OpcionesMenues99)
    {
        $OpcionesMenues99 = OpcionesMenues99::find($OpcionesMenues99);
        return view('cruds/OpcionesMenues99.show', compact('OpcionesMenues99'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  OpcionesMenues99 $OpcionesMenues99
     * @return \Illuminate\Http\Response
     */
    public function edit(OpcionesMenues99 $OpcionesMenues99)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  OpcionesMenues99 $OpcionesMenues99
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OpcionesMenues99 $OpcionesMenues99)
    {
		//

    
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  OpcionesMenues99 $OpcionesMenues99
     * @return \Illuminate\Http\Response
     */
    public function destroy(OpcionesMenues99 $OpcionesMenues99)
    {
		//
    }
	
		
	
}
