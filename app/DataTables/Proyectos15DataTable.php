<?php

namespace App\DataTables;

use App\Models\Proyectos15;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Proyectos15DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idproyecto', function (Proyectos15 $Proyectos15) {
return $Proyectos15->idproyecto;
})
->editColumn('nombre', function (Proyectos15 $Proyectos15) {
return $Proyectos15->nombre;
})
->editColumn('idcliente', function (Proyectos15 $Proyectos15) {
return $Proyectos15->idcliente;
})
->editColumn('logo', function (Proyectos15 $Proyectos15) {
return $Proyectos15->logo;
})
->editColumn('direccion', function (Proyectos15 $Proyectos15) {
return $Proyectos15->direccion;
})
->editColumn('idestatus', function (Proyectos15 $Proyectos15) {
return $Proyectos15->idestatus;
})
->editColumn('identificadorcontrato', function (Proyectos15 $Proyectos15) {
return $Proyectos15->identificadorcontrato;
})
->editColumn('codigoubicacion', function (Proyectos15 $Proyectos15) {
return $Proyectos15->codigoubicacion;
})

            
            ->addColumn('action', function (Proyectos15 $Proyectos15) {
                return view('cruds/Proyectos15.columns._actions', compact('Proyectos15'));
            })
            ->setRowId('idproyecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Proyectos15 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Proyectos15-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Proyectos15/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idproyecto'),
Column::make('nombre'),
Column::make('idcliente'),
Column::make('logo'),
Column::make('direccion'),
Column::make('idestatus'),
Column::make('identificadorcontrato'),
Column::make('codigoubicacion'),

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
        return 'Proyectos15_' . date('YmdHis');
    }
}
