<?php

namespace App\DataTables;

use App\Models\Proyectos9;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Proyectos9DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idproyecto', function (Proyectos9 $Proyectos9) {
return $Proyectos9->idproyecto;
})
->editColumn('nombre', function (Proyectos9 $Proyectos9) {
return $Proyectos9->nombre;
})
->editColumn('idestatus', function (Proyectos9 $Proyectos9) {
return $Proyectos9->idestatus;
})

            
            ->addColumn('action', function (Proyectos9 $Proyectos9) {
                return view('cruds/Proyectos9.columns._actions', compact('Proyectos9'));
            })
            ->setRowId('idproyecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Proyectos9 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Proyectos9-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Proyectos9/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idproyecto'),
Column::make('nombre'),
Column::make('idestatus'),

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
        return 'Proyectos9_' . date('YmdHis');
    }
}
