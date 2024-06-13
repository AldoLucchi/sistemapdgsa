<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Usuarios1DataTable;
use App\Models\Usuarios1;
use Exception;
use Illuminate\Support\Facades\Log;



class Usuarios1Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Usuarios1DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Usuarios1.list');

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
      Log::info('Usuarios1Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Usuarios1 = Usuarios1::create($request->all());

        return redirect('/crud/Usuarios1');
      } catch (Exception $e) {
          Log::info('Usuarios1Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Usuarios1 $Usuarios1
     * @return \Illuminate\Http\Response
     */
    public function show( $Usuarios1)
    {
        $Usuarios1 = Usuarios1::find($Usuarios1);
        return view('cruds/Usuarios1.show', compact('Usuarios1'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Usuarios1 $Usuarios1
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios1 $Usuarios1)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Usuarios1 $Usuarios1
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios1 $Usuarios1)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Usuarios1 $Usuarios1
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios1 $Usuarios1)
    {
		//
    }
	
		
	
}
