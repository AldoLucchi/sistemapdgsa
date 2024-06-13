<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Proyectos9DataTable;
use App\Models\Proyectos9;
use Exception;
use Illuminate\Support\Facades\Log;



class Proyectos9Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos9DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Proyectos9.list');

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
      Log::info('Proyectos9Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Proyectos9 = Proyectos9::create($request->all());

        return redirect('/crud/Proyectos9');
      } catch (Exception $e) {
          Log::info('Proyectos9Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Proyectos9 $Proyectos9
     * @return \Illuminate\Http\Response
     */
    public function show( $Proyectos9)
    {
        $Proyectos9 = Proyectos9::find($Proyectos9);
        return view('cruds/Proyectos9.show', compact('Proyectos9'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proyectos9 $Proyectos9
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos9 $Proyectos9)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proyectos9 $Proyectos9
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos9 $Proyectos9)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proyectos9 $Proyectos9
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos9 $Proyectos9)
    {
		//
    }
	
		
	
}
