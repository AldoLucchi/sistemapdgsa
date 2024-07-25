<?php

namespace App\Services;

use App\Models\Crud;
use App\Models\Documentos61;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class DocumentoService
{
    private $etiquetasDocumentosService;

    public function __construct(
        EtiquetaDocumentoService $etiquetasDocumentosService,
    ) {
        $this->etiquetasDocumentosService = $etiquetasDocumentosService;
    }

    public function getDocumentosByCrud($crud)
    {
        Log::info('DocumentoService - getDocumentosByCrud');
        $crud = Crud::where('nombre_componente', $crud)->first();

        $documentosArray = [];

        if ($crud) {
            $tabla = $crud->nombre;
            if ($tabla) {
                $documentos = Documentos61::where('tabla', $tabla)->get();
                
                foreach ($documentos as $documento) {
                    $documentosArray[$documento->alias] = '/generarPdf/' . $documento->iddocumento.'/';
                }
            }
        }
        Log::info($documentosArray);

        return $documentosArray;
    }

    public function generarPdf($idDocumento, $idRegister)
    {
        Log::info('DocumentoService - generarPdf');
        $Documentos61 = Documentos61::find($idDocumento);
        $html = $Documentos61->documento;
        $html = $this->etiquetasDocumentosService->replaceVariables($html, $idRegister);
        $pdf = App::make("dompdf.wrapper");
        Log::info($html);
        $pdf->loadHTML($html);
        //$pdf->save(public_path() . "/docs/Documentos61_" . $Documentos61->iddocumento . ".pdf");

        return $pdf->stream();
    }
}
