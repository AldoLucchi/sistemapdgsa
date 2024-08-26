<?php

namespace App\Http\Controllers;

use App\Services\FirmaService;
use App\Services\FunctionsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class FirmaController extends Controller
{
    private $firmaService;
    private $functionsService;


    public function __construct(
        FirmaService $firmaService,
        FunctionsService $functionsService
    ) {
        $this->firmaService = $firmaService;
        $this->functionsService = $functionsService;
    }


    public function getDataFirma(Request $request, $table = null, $idRegister = null)
    {
        Log::info('FirmaController - getDataFirma');
        Log::info($request);

        if (isset($request['table'])) {
            $table = $request['table'];
        }

        if (isset($request['idRegister'])) {
            $idRegister = $request['idRegister'];
        }

        $data = $this->firmaService->getDataFirma($table, $idRegister);
        $data['table']       = $table;
        $data['idRegister']       = $idRegister;

        return view('pages/firma.index', $data);
    }


    public function registrarFirma(Request $request, $table, $idRegister)
    {
        Log::info('FirmaController - registrarFirma');
        Log::info($request);

        $data = $this->firmaService->getDataRegistrarFirma($table, $idRegister);
        $data['table']       = $table;
        $data['idRegister']       = $idRegister;

        return view('pages/firma.register', $data);
    }

    public function registrarFirmaGenerada(Request $request)
    {
        Log::info('FirmaController - registrarFirmaGenerada');
        //Log::info($request);  

        $data = $this->firmaService->registrarFirmaGenerada($request->all());

        return redirect('registrarFirma/' . $request['table'] . '/' . $request['idRegister'])->with('message', 'Firma generada correctamente: ' . $data);
    }

    public function registrarFirmaCliente(Request $request, $table, $idRegister)
    {   
        Log::info('FirmaController - registrarFirma');
        Log::info($request);

        $data = $this->firmaService->getDataRegistrarFirma($table, $idRegister);
        $data['table']       = $table;
        $data['idRegister']       = $idRegister;

        return view('pages/firma.register-cliente', $data);
    }
}
