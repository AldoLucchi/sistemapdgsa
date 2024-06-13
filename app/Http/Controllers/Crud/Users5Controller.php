<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users5DataTable;
use App\Models\Users5;
use Exception;
use Illuminate\Support\Facades\Log;



class Users5Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users5DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users5.list');

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
      Log::info('Users5Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Users5 = Users5::create($request->all());

        return redirect('/crud/Users5');
      } catch (Exception $e) {
          Log::info('Users5Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users5 $Users5
     * @return \Illuminate\Http\Response
     */
    public function show( $Users5)
    {
        $Users5 = Users5::find($Users5);
        return view('cruds/Users5.show', compact('Users5'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users5 $Users5
     * @return \Illuminate\Http\Response
     */
    public function edit(Users5 $Users5)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users5 $Users5
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users5 $Users5)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users5 $Users5
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users5 $Users5)
    {
		//
    }
	
		
	
}
