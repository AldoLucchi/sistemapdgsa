<?php

namespace App\Http\Controllers;

use App\Services\FirmaService;
use Illuminate\Http\Request;

class FirmaController extends Controller
{
    private $firmaService;

    public function __construct(
        FirmaService $firmaService
    ) {
        $this->firmaService = $firmaService;
    }

    public function getDataFirma(){
        
        $data = $this->firmaService->getDataFirma();        

        return view('pages/firma.index', $data);
    }
}
