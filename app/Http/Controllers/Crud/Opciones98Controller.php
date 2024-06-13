<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Opciones98DataTable;
use App\Models\Opciones98;
use Exception;
use Illuminate\Support\Facades\Log;



class Opciones98Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Opciones98DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Opciones98.list');

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
      Log::info('Opciones98Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Opciones98 = Opciones98::create($request->all());

        return redirect('/crud/Opciones98');
      } catch (Exception $e) {
          Log::info('Opciones98Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Opciones98 $Opciones98
     * @return \Illuminate\Http\Response
     */
    public function show( $Opciones98)
    {
        $Opciones98 = Opciones98::find($Opciones98);
        return view('cruds/Opciones98.show', compact('Opciones98'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Opciones98 $Opciones98
     * @return \Illuminate\Http\Response
     */
    public function edit(Opciones98 $Opciones98)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Opciones98 $Opciones98
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Opciones98 $Opciones98)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Opciones98 $Opciones98
     * @return \Illuminate\Http\Response
     */
    public function destroy(Opciones98 $Opciones98)
    {
		//
    }
	
		
	
}
