<?php

namespace App\DataTables;

use App\Models\OpcionesMenues99;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class OpcionesMenues99DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idopcionnmenu', function (OpcionesMenues99 $OpcionesMenues99) {
return $OpcionesMenues99->idopcionnmenu;
})
->editColumn('idopcion', function (OpcionesMenues99 $OpcionesMenues99) {
return $OpcionesMenues99->Opciones->first()?->opcion;
})
->editColumn('idmenu', function (OpcionesMenues99 $OpcionesMenues99) {
return $OpcionesMenues99->Menues->first()?->menu;
})
->editColumn('posicion', function (OpcionesMenues99 $OpcionesMenues99) {
return $OpcionesMenues99->posicion;
})
->editColumn('estatus', function (OpcionesMenues99 $OpcionesMenues99) {
return ($OpcionesMenues99->estatus?"ON":"OFF");
})

            
            ->addColumn('action', function (OpcionesMenues99 $OpcionesMenues99) {
                return view('cruds/OpcionesMenues99.columns._actions', compact('OpcionesMenues99'));
            })
            ->setRowId('idopcionnmenu');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(OpcionesMenues99 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('OpcionesMenues99-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/OpcionesMenues99/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idopcionnmenu'),
Column::make('idopcion'),
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
        return 'OpcionesMenues99_' . date('YmdHis');
    }
}
