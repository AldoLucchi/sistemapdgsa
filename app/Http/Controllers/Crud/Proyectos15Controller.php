<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Proyectos15DataTable;
use App\Models\Proyectos15;
use Exception;
use Illuminate\Support\Facades\Log;



class Proyectos15Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos15DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Proyectos15.list');

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
      Log::info('Proyectos15Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Proyectos15 = Proyectos15::create($request->all());

        return redirect('/crud/Proyectos15');
      } catch (Exception $e) {
          Log::info('Proyectos15Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Proyectos15 $Proyectos15
     * @return \Illuminate\Http\Response
     */
    public function show( $Proyectos15)
    {
        $Proyectos15 = Proyectos15::find($Proyectos15);
        return view('cruds/Proyectos15.show', compact('Proyectos15'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proyectos15 $Proyectos15
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos15 $Proyectos15)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proyectos15 $Proyectos15
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos15 $Proyectos15)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proyectos15 $Proyectos15
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos15 $Proyectos15)
    {
		//
    }
	
		
	
}
