<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Clientes4DataTable;
use App\Models\Clientes4;
use Exception;
use Illuminate\Support\Facades\Log;



class Clientes4Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Clientes4DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Clientes4.list');

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
      Log::info('Clientes4Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Clientes4 = Clientes4::create($request->all());

        return redirect('/crud/Clientes4');
      } catch (Exception $e) {
          Log::info('Clientes4Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Clientes4 $Clientes4
     * @return \Illuminate\Http\Response
     */
    public function show( $Clientes4)
    {
        $Clientes4 = Clientes4::find($Clientes4);
        return view('cruds/Clientes4.show', compact('Clientes4'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Clientes4 $Clientes4
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes4 $Clientes4)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Clientes4 $Clientes4
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes4 $Clientes4)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Clientes4 $Clientes4
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes4 $Clientes4)
    {
		//
    }
	
		
	
}
