<?php

namespace App\DataTables;

use App\Models\CrudsGeneradosMenues100;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CrudsGeneradosMenues100DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idcrudgenmenu', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
return $CrudsGeneradosMenues100->idcrudgenmenu;
})
->editColumn('idcrudgen', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
return $CrudsGeneradosMenues100->crud->nombre;
})
->editColumn('idmenu', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
return $CrudsGeneradosMenues100->menu->menu;
})
->editColumn('posicion', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
return $CrudsGeneradosMenues100->posicion;
})
->editColumn('estatus', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
return ($CrudsGeneradosMenues100->estatus?"ON":"OFF");
})

            
            ->addColumn('action', function (CrudsGeneradosMenues100 $CrudsGeneradosMenues100) {
                return view('cruds/CrudsGeneradosMenues100.columns._actions', compact('CrudsGeneradosMenues100'));
            })
            ->setRowId('idcrudgenmenu');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(CrudsGeneradosMenues100 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('CrudsGeneradosMenues100-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/CrudsGeneradosMenues100/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idcrudgenmenu'),
Column::make('idcrudgen'),
Column::make('idmenu'),
Column::make('posicion'),
Column::make('estatus'),

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
        return 'CrudsGeneradosMenues100_' . date('YmdHis');
    }
}
