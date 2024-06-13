<?php

namespace App\DataTables;

use App\Models\Proyectos7;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Proyectos7DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idproyecto', function (Proyectos7 $Proyectos7) {
return $Proyectos7->idproyecto;
})
->editColumn('idcliente', function (Proyectos7 $Proyectos7) {
return $Proyectos7->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Proyectos7 $Proyectos7) {
return $Proyectos7->nombre;
})

            
            ->addColumn('action', function (Proyectos7 $Proyectos7) {
                return view('cruds/Proyectos7.columns._actions', compact('Proyectos7'));
            })
            ->setRowId('idproyecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Proyectos7 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Proyectos7-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Proyectos7/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idproyecto'),
Column::make('idcliente'),
Column::make('nombre'),

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
        return 'Proyectos7_' . date('YmdHis');
    }
}
