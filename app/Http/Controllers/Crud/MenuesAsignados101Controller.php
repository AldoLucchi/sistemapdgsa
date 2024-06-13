<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\MenuesAsignados101DataTable;
use App\Models\MenuesAsignados101;
use Exception;
use Illuminate\Support\Facades\Log;



class MenuesAsignados101Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MenuesAsignados101DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/MenuesAsignados101.list');

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
      Log::info('MenuesAsignados101Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                

      try{
        $MenuesAsignados101 = MenuesAsignados101::create($request->all());

        return redirect('/crud/MenuesAsignados101');
      } catch (Exception $e) {
          Log::info('MenuesAsignados101Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  MenuesAsignados101 $MenuesAsignados101
     * @return \Illuminate\Http\Response
     */
    public function show( $MenuesAsignados101)
    {
        $MenuesAsignados101 = MenuesAsignados101::find($MenuesAsignados101);
        return view('cruds/MenuesAsignados101.show', compact('MenuesAsignados101'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  MenuesAsignados101 $MenuesAsignados101
     * @return \Illuminate\Http\Response
     */
    public function edit(MenuesAsignados101 $MenuesAsignados101)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  MenuesAsignados101 $MenuesAsignados101
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MenuesAsignados101 $MenuesAsignados101)
    {
		//

    
                $request["estatus"] = ( isset($request["estatus"])?1:0); 
                
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MenuesAsignados101 $MenuesAsignados101
     * @return \Illuminate\Http\Response
     */
    public function destroy(MenuesAsignados101 $MenuesAsignados101)
    {
		//
    }
	
		
	
}
