<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Proyectos7DataTable;
use App\Models\Proyectos7;
use Exception;
use Illuminate\Support\Facades\Log;



class Proyectos7Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos7DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Proyectos7.list');

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
      Log::info('Proyectos7Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Proyectos7 = Proyectos7::create($request->all());

        return redirect('/crud/Proyectos7');
      } catch (Exception $e) {
          Log::info('Proyectos7Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Proyectos7 $Proyectos7
     * @return \Illuminate\Http\Response
     */
    public function show( $Proyectos7)
    {
        $Proyectos7 = Proyectos7::find($Proyectos7);
        return view('cruds/Proyectos7.show', compact('Proyectos7'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proyectos7 $Proyectos7
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos7 $Proyectos7)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proyectos7 $Proyectos7
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos7 $Proyectos7)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proyectos7 $Proyectos7
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos7 $Proyectos7)
    {
		//
    }
	
		
	
}
