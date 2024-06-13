<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users8DataTable;
use App\Models\Users8;
use Exception;
use Illuminate\Support\Facades\Log;



class Users8Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users8DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users8.list');

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
      Log::info('Users8Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Users8 = Users8::create($request->all());

        return redirect('/crud/Users8');
      } catch (Exception $e) {
          Log::info('Users8Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users8 $Users8
     * @return \Illuminate\Http\Response
     */
    public function show( $Users8)
    {
        $Users8 = Users8::find($Users8);
        return view('cruds/Users8.show', compact('Users8'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users8 $Users8
     * @return \Illuminate\Http\Response
     */
    public function edit(Users8 $Users8)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users8 $Users8
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users8 $Users8)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users8 $Users8
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users8 $Users8)
    {
		//
    }
	
		
	
}
