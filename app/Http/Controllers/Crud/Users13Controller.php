<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users13DataTable;
use App\Models\Users13;
use Exception;
use Illuminate\Support\Facades\Log;



class Users13Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users13DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users13.list');

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
      Log::info('Users13Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      
                $request["insertar"] = ( isset($request["insertar"])?1:0); 
                
                $request["editar"] = ( isset($request["editar"])?1:0); 
                
                $request["listar"] = ( isset($request["listar"])?1:0); 
                
                $request["eliminar"] = ( isset($request["eliminar"])?1:0); 
                
                $request["imprimir"] = ( isset($request["imprimir"])?1:0); 
                

      try{
        $Users13 = Users13::create($request->all());

        return redirect('/crud/Users13');
      } catch (Exception $e) {
          Log::info('Users13Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users13 $Users13
     * @return \Illuminate\Http\Response
     */
    public function show( $Users13)
    {
        $Users13 = Users13::find($Users13);
        return view('cruds/Users13.show', compact('Users13'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users13 $Users13
     * @return \Illuminate\Http\Response
     */
    public function edit(Users13 $Users13)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users13 $Users13
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users13 $Users13)
    {
		//

    
                $request["insertar"] = ( isset($request["insertar"])?1:0); 
                
                $request["editar"] = ( isset($request["editar"])?1:0); 
                
                $request["listar"] = ( isset($request["listar"])?1:0); 
                
                $request["eliminar"] = ( isset($request["eliminar"])?1:0); 
                
                $request["imprimir"] = ( isset($request["imprimir"])?1:0); 
                
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users13 $Users13
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users13 $Users13)
    {
		//
    }
	
		
	
}
