<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\CrudsGeneradosMenues100DataTable;
use App\Models\CrudsGeneradosMenues100;
use Exception;
use Illuminate\Support\Facades\Log;



class CrudsGeneradosMenues100Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CrudsGeneradosMenues100DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/CrudsGeneradosMenues100.list');

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
      Log::info('CrudsGeneradosMenues100Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                

      try{
        $CrudsGeneradosMenues100 = CrudsGeneradosMenues100::create($request->all());

        return redirect('/crud/CrudsGeneradosMenues100');
      } catch (Exception $e) {
          Log::info('CrudsGeneradosMenues100Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  CrudsGeneradosMenues100 $CrudsGeneradosMenues100
     * @return \Illuminate\Http\Response
     */
    public function show( $CrudsGeneradosMenues100)
    {
        $CrudsGeneradosMenues100 = CrudsGeneradosMenues100::find($CrudsGeneradosMenues100);
        return view('cruds/CrudsGeneradosMenues100.show', compact('CrudsGeneradosMenues100'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  CrudsGeneradosMenues100 $CrudsGeneradosMenues100
     * @return \Illuminate\Http\Response
     */
    public function edit(CrudsGeneradosMenues100 $CrudsGeneradosMenues100)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  CrudsGeneradosMenues100 $CrudsGeneradosMenues100
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CrudsGeneradosMenues100 $CrudsGeneradosMenues100)
    {
		//

    
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  CrudsGeneradosMenues100 $CrudsGeneradosMenues100
     * @return \Illuminate\Http\Response
     */
    public function destroy(CrudsGeneradosMenues100 $CrudsGeneradosMenues100)
    {
		//
    }
	
		
	
}
