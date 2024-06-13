<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users10DataTable;
use App\Models\Users10;
use Exception;
use Illuminate\Support\Facades\Log;



class Users10Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users10DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users10.list');

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
      Log::info('Users10Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Users10 = Users10::create($request->all());

        return redirect('/crud/Users10');
      } catch (Exception $e) {
          Log::info('Users10Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users10 $Users10
     * @return \Illuminate\Http\Response
     */
    public function show( $Users10)
    {
        $Users10 = Users10::find($Users10);
        return view('cruds/Users10.show', compact('Users10'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users10 $Users10
     * @return \Illuminate\Http\Response
     */
    public function edit(Users10 $Users10)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users10 $Users10
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users10 $Users10)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users10 $Users10
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users10 $Users10)
    {
		//
    }
	
		
	
}
