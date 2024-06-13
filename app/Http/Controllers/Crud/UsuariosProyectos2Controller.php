<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsuariosProyectos2DataTable;
use App\Models\UsuariosProyectos2;
use Exception;
use Illuminate\Support\Facades\Log;



class UsuariosProyectos2Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsuariosProyectos2DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/UsuariosProyectos2.list');

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
      Log::info('UsuariosProyectos2Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $UsuariosProyectos2 = UsuariosProyectos2::create($request->all());

        return redirect('/crud/UsuariosProyectos2');
      } catch (Exception $e) {
          Log::info('UsuariosProyectos2Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  UsuariosProyectos2 $UsuariosProyectos2
     * @return \Illuminate\Http\Response
     */
    public function show( $UsuariosProyectos2)
    {
        $UsuariosProyectos2 = UsuariosProyectos2::find($UsuariosProyectos2);
        return view('cruds/UsuariosProyectos2.show', compact('UsuariosProyectos2'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UsuariosProyectos2 $UsuariosProyectos2
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuariosProyectos2 $UsuariosProyectos2)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UsuariosProyectos2 $UsuariosProyectos2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuariosProyectos2 $UsuariosProyectos2)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UsuariosProyectos2 $UsuariosProyectos2
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuariosProyectos2 $UsuariosProyectos2)
    {
		//
    }
	
		
	
}
