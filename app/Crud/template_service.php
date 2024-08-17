<?php

namespace App\Services\Crud;

%TABLAS_ASOCIADAS_USE%

class %OBJETO_SERVICE%
{
    public function getData(){

        %TABLAS_ASOCIADAS_GET%

        $data = [
          %TABLAS_ASOCIADAS%
          
        ];

        return $data;
    }
}