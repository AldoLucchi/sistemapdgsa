<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users12DataTable;
use App\Models\Users12;
use Exception;
use Illuminate\Support\Facades\Log;



class Users12Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users12DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users12.list');

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
      Log::info('Users12Controller - store');
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
        $Users12 = Users12::create($request->all());

        return redirect('/crud/Users12');
      } catch (Exception $e) {
          Log::info('Users12Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users12 $Users12
     * @return \Illuminate\Http\Response
     */
    public function show( $Users12)
    {
        $Users12 = Users12::find($Users12);
        return view('cruds/Users12.show', compact('Users12'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users12 $Users12
     * @return \Illuminate\Http\Response
     */
    public function edit(Users12 $Users12)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users12 $Users12
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users12 $Users12)
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
     * @param  Users12 $Users12
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users12 $Users12)
    {
		//
    }
	
		
	
}
