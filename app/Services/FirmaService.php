<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FirmaService
{

    public function getDataFirma($tableSelected = null, $idRegister = null)
    {

        $tables = DB::select('SHOW TABLES');

        $tables_firma = [];
        // $registers_firma = [];
        $register = null;

        foreach ($tables as $i => $crud_table) {
            $table_name = $crud_table->Tables_in_pdgsabd;

            $columns = DB::select("SHOW COLUMNS FROM " . $table_name);

            foreach ($columns as $column) {
                if ($column->Field == 'firma') {
                    $tables_firma[$table_name] = $table_name;

                    //$registers = DB::table($table_name)->get();
                    //$registers_firma[$table_name] = $registers;
                }
            }
        }

        $registerKey = '';
        $registerColumns = '';
        if ($tableSelected && $idRegister) {
            $registerColumns = DB::select("SHOW COLUMNS FROM " . $tableSelected);


            foreach ($registerColumns as $column) {
                if ($column->Key == 'PRI') {
                    $registerKey = $column->Field;
                }
            }
            $register = DB::table($tableSelected)->where($registerKey, $idRegister)->first();
        }

        $data = [
            'tables' => $tables_firma,
            //'registers' => $registers_firma
            'register' => $register,
            'registerKey' => $registerKey,
            'registerColumns' => $registerColumns,
        ];

        return  $data;
    }

    public function getDataRegistrarFirma($tableSelected, $idRegister)
    {
        $registerKey = '';
        $registerColumns = '';
        if ($tableSelected && $idRegister) {
            $registerColumns = DB::select("SHOW COLUMNS FROM " . $tableSelected);


            foreach ($registerColumns as $column) {
                if ($column->Key == 'PRI') {
                    $registerKey = $column->Field;
                }
            }
            $register = DB::table($tableSelected)->where($registerKey, $idRegister)->first();
        }

        $data = [
            'register' => $register,
            'registerKey' => $registerKey,
            'registerColumns' => $registerColumns,
        ];

        return  $data;
    }
}
