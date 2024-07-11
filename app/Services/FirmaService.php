<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FirmaService
{

    public function getDataFirma(){

        $tables = DB::select('SHOW TABLES');

        $tables_firma = [];
        $registers_firma = [];

        foreach ($tables as $i => $crud_table) {
            $table_name = $crud_table->Tables_in_pdgsabd;

            $columns = DB::select("SHOW COLUMNS FROM " . $table_name);

            foreach($columns as $column){
                if($column->Field == 'firma'){
                    $tables_firma[$table_name] = $table_name;
                    $registers = DB::table($table_name)->get();
                    $registers_firma[$table_name] = $registers;
                }
            }
        }

        $data = [
            'tables' => $tables_firma,
            'registers' => $registers_firma
        ];

        return  $data;       
    }
}