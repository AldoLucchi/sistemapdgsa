<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Menues97DataTable;
use App\Models\Menues97;
use Exception;
use Illuminate\Support\Facades\Log;



class Menues97Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Menues97DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Menues97.list');

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
      Log::info('Menues97Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                

      try{
        $Menues97 = Menues97::create($request->all());

        return redirect('/crud/Menues97');
      } catch (Exception $e) {
          Log::info('Menues97Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Menues97 $Menues97
     * @return \Illuminate\Http\Response
     */
    public function show( $Menues97)
    {
        $Menues97 = Menues97::find($Menues97);
        return view('cruds/Menues97.show', compact('Menues97'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menues97 $Menues97
     * @return \Illuminate\Http\Response
     */
    public function edit(Menues97 $Menues97)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Menues97 $Menues97
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menues97 $Menues97)
    {
		//

    
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Menues97 $Menues97
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menues97 $Menues97)
    {
		//
    }
	
		
	
}
