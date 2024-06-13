<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\Users4DataTable;
use App\Models\Users4;
use Exception;
use Illuminate\Support\Facades\Log;



class Users4Controller extends Controller
{	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Users4DataTable $dataTable)
    {			
		
        return $dataTable->render('cruds/Users4.list');

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
      Log::info('Users4Controller - store');
      Log::info($request);

      $validated = $request->validate([
          //'name' => 'required',
      ]);

      

      try{
        $Users4 = Users4::create($request->all());

        return redirect('/crud/Users4');
      } catch (Exception $e) {
          Log::info('Users4Controller - store - Exception ' . $e->getMessage());

          return redirect('/');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Users4 $Users4
     * @return \Illuminate\Http\Response
     */
    public function show( $Users4)
    {
        $Users4 = Users4::find($Users4);
        return view('cruds/Users4.show', compact('Users4'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Users4 $Users4
     * @return \Illuminate\Http\Response
     */
    public function edit(Users4 $Users4)
    {
		//
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Users4 $Users4
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Users4 $Users4)
    {
		//

    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Users4 $Users4
     * @return \Illuminate\Http\Response
     */
    public function destroy(Users4 $Users4)
    {
		//
    }
	
		
	
}
