<?php

namespace App\Http\Controllers;

use App\Services\FirmaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FirmaController extends Controller
{
    private $firmaService;

    public function __construct(
        FirmaService $firmaService
    ) {
        $this->firmaService = $firmaService;
    }

    public function getDataFirma(Request $request, $table = null, $idRegister = null)
    {
        Log::info('getDataFirma');
        Log::info($request);

        if(isset($request['table'])){
            $table = $request['table'];
        }

        if(isset($request['idRegister'])){
            $idRegister = $request['idRegister'];
        }

        $data = $this->firmaService->getDataFirma($table, $idRegister);
        $data['table']       = $table;
        $data['idRegister']       = $idRegister;

        return view('pages/firma.index', $data);
    }


    public function registrarFirma(Request $request, $table , $idRegister)
    {
        Log::info('registrarFirma');
        Log::info($request);        

        $data = $this->firmaService->getDataRegistrarFirma($table, $idRegister);
        $data['table']       = $table;
        $data['idRegister']       = $idRegister;

        return view('pages/firma.register', $data);
    }
}
