<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Proyectos3DataTable;
use App\Models\Proyectos3;
use Exception;
use Illuminate\Support\Facades\Log;



class Proyectos3Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos3DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Proyectos3.list');

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
      Log::info('Proyectos3Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Proyectos3 = Proyectos3::create($request->all());

        return redirect('/crud/Proyectos3');
      } catch (Exception $e) {
          Log::info('Proyectos3Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Proyectos3 $Proyectos3
     * @return \Illuminate\Http\Response
     */
    public function show( $Proyectos3)
    {
        $Proyectos3 = Proyectos3::find($Proyectos3);
        return view('cruds/Proyectos3.show', compact('Proyectos3'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proyectos3 $Proyectos3
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos3 $Proyectos3)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proyectos3 $Proyectos3
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos3 $Proyectos3)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proyectos3 $Proyectos3
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos3 $Proyectos3)
    {
		//
    }
	
		
	
}
