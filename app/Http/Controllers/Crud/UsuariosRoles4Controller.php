<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\UsuariosRoles4DataTable;
use App\Models\UsuariosRoles4;
use Exception;
use Illuminate\Support\Facades\Log;



class UsuariosRoles4Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsuariosRoles4DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/UsuariosRoles4.list');

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
      Log::info('UsuariosRoles4Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $UsuariosRoles4 = UsuariosRoles4::create($request->all());

        return redirect('/crud/UsuariosRoles4');
      } catch (Exception $e) {
          Log::info('UsuariosRoles4Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  UsuariosRoles4 $UsuariosRoles4
     * @return \Illuminate\Http\Response
     */
    public function show( $UsuariosRoles4)
    {
        $UsuariosRoles4 = UsuariosRoles4::find($UsuariosRoles4);
        return view('cruds/UsuariosRoles4.show', compact('UsuariosRoles4'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  UsuariosRoles4 $UsuariosRoles4
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuariosRoles4 $UsuariosRoles4)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  UsuariosRoles4 $UsuariosRoles4
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuariosRoles4 $UsuariosRoles4)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  UsuariosRoles4 $UsuariosRoles4
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuariosRoles4 $UsuariosRoles4)
    {
		//
    }
	
		
	
}
