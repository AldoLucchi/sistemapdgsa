<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Contactos4DataTable;
use App\Models\Contactos4;
use Exception;
use Illuminate\Support\Facades\Log;



class Contactos4Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contactos4DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Contactos4.list');

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
      Log::info('Contactos4Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Contactos4 = Contactos4::create($request->all());

        return redirect('/crud/Contactos4');
      } catch (Exception $e) {
          Log::info('Contactos4Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Contactos4 $Contactos4
     * @return \Illuminate\Http\Response
     */
    public function show( $Contactos4)
    {
        $Contactos4 = Contactos4::find($Contactos4);
        return view('cruds/Contactos4.show', compact('Contactos4'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Contactos4 $Contactos4
     * @return \Illuminate\Http\Response
     */
    public function edit(Contactos4 $Contactos4)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Contactos4 $Contactos4
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contactos4 $Contactos4)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Contactos4 $Contactos4
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contactos4 $Contactos4)
    {
		//
    }
	
		
	
}
