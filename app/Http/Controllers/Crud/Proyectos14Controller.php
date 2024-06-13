<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Proyectos14DataTable;
use App\Models\Proyectos14;
use Exception;
use Illuminate\Support\Facades\Log;



class Proyectos14Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Proyectos14DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Proyectos14.list');

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
      Log::info('Proyectos14Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Proyectos14 = Proyectos14::create($request->all());

        return redirect('/crud/Proyectos14');
      } catch (Exception $e) {
          Log::info('Proyectos14Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Proyectos14 $Proyectos14
     * @return \Illuminate\Http\Response
     */
    public function show( $Proyectos14)
    {
        $Proyectos14 = Proyectos14::find($Proyectos14);
        return view('cruds/Proyectos14.show', compact('Proyectos14'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Proyectos14 $Proyectos14
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyectos14 $Proyectos14)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Proyectos14 $Proyectos14
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyectos14 $Proyectos14)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Proyectos14 $Proyectos14
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyectos14 $Proyectos14)
    {
		//
    }
	
		
	
}
