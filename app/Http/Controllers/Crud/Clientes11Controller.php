<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Clientes11DataTable;
use App\Models\Clientes11;
use Exception;
use Illuminate\Support\Facades\Log;



class Clientes11Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clientes11DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Clientes11.list');

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
      Log::info('Clientes11Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Clientes11 = Clientes11::create($request->all());

        return redirect('/crud/Clientes11');
      } catch (Exception $e) {
          Log::info('Clientes11Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Clientes11 $Clientes11
     * @return \Illuminate\Http\Response
     */
    public function show( $Clientes11)
    {
        $Clientes11 = Clientes11::find($Clientes11);
        return view('cruds/Clientes11.show', compact('Clientes11'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Clientes11 $Clientes11
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes11 $Clientes11)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Clientes11 $Clientes11
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes11 $Clientes11)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Clientes11 $Clientes11
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes11 $Clientes11)
    {
		//
    }
	
		
	
}
