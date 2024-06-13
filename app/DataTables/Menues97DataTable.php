<?php

namespace App\DataTables;

use App\Models\Menues97;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Menues97DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idmenu', function (Menues97 $Menues97) {
return $Menues97->idmenu;
})
->editColumn('menu', function (Menues97 $Menues97) {
return $Menues97->menu;
})
->editColumn('estatus', function (Menues97 $Menues97) {
return ($Menues97->estatus?"ON":"OFF");
})
->editColumn('ruta', function (Menues97 $Menues97) {
return $Menues97->ruta;
})

            
            ->addColumn('action', function (Menues97 $Menues97) {
                return view('cruds/Menues97.columns._actions', compact('Menues97'));
            })
            ->setRowId('idmenu');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Menues97 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Menues97-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Menues97/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idmenu'),
Column::make('menu'),
Column::make('estatus'),
Column::make('ruta'),

            Column::computed('action')
                ->addClass('text-end text-nowrap')
                ->exportable(false)
                ->printable(false)
                ->width(60)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Menues97_' . date('YmdHis');
    }
}
