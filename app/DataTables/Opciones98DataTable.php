<?php

namespace App\DataTables;

use App\Models\Opciones98;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Opciones98DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idopcion', function (Opciones98 $Opciones98) {
return $Opciones98->idopcion;
})
->editColumn('opcion', function (Opciones98 $Opciones98) {
return $Opciones98->opcion;
})
->editColumn('ruta', function (Opciones98 $Opciones98) {
return $Opciones98->ruta;
})

            
            ->addColumn('action', function (Opciones98 $Opciones98) {
                return view('cruds/Opciones98.columns._actions', compact('Opciones98'));
            })
            ->setRowId('idopcion');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Opciones98 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Opciones98-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Opciones98/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idopcion'),
Column::make('opcion'),
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
        return 'Opciones98_' . date('YmdHis');
    }
}
