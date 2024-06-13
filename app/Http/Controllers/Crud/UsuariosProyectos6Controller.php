<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsuariosProyectos6DataTable;
use App\Models\UsuariosProyectos6;
use Exception;
use Illuminate\Support\Facades\Log;



class UsuariosProyectos6Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsuariosProyectos6DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/UsuariosProyectos6.list');

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
      Log::info('UsuariosProyectos6Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $UsuariosProyectos6 = UsuariosProyectos6::create($request->all());

        return redirect('/crud/UsuariosProyectos6');
      } catch (Exception $e) {
          Log::info('UsuariosProyectos6Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  UsuariosProyectos6 $UsuariosProyectos6
     * @return \Illuminate\Http\Response
     */
    public function show( $UsuariosProyectos6)
    {
        $UsuariosProyectos6 = UsuariosProyectos6::find($UsuariosProyectos6);
        return view('cruds/UsuariosProyectos6.show', compact('UsuariosProyectos6'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UsuariosProyectos6 $UsuariosProyectos6
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuariosProyectos6 $UsuariosProyectos6)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UsuariosProyectos6 $UsuariosProyectos6
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuariosProyectos6 $UsuariosProyectos6)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UsuariosProyectos6 $UsuariosProyectos6
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuariosProyectos6 $UsuariosProyectos6)
    {
		//
    }
	
		
	
}
