<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users6DataTable;
use App\Models\Users6;
use Exception;
use Illuminate\Support\Facades\Log;



class Users6Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users6DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users6.list');

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
      Log::info('Users6Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Users6 = Users6::create($request->all());

        return redirect('/crud/Users6');
      } catch (Exception $e) {
          Log::info('Users6Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users6 $Users6
     * @return \Illuminate\Http\Response
     */
    public function show( $Users6)
    {
        $Users6 = Users6::find($Users6);
        return view('cruds/Users6.show', compact('Users6'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users6 $Users6
     * @return \Illuminate\Http\Response
     */
    public function edit(Users6 $Users6)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users6 $Users6
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users6 $Users6)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users6 $Users6
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users6 $Users6)
    {
		//
    }
	
		
	
}
