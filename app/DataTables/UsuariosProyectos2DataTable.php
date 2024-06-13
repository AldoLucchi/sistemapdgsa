<?php

namespace App\DataTables;

use App\Models\UsuariosProyectos2;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class UsuariosProyectos2DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idusuarioproyecto', function (UsuariosProyectos2 $UsuariosProyectos2) {
return $UsuariosProyectos2->idusuarioproyecto;
})
->editColumn('idusuario', function (UsuariosProyectos2 $UsuariosProyectos2) {
return $UsuariosProyectos2->idusuario;
})
->editColumn('idproyecto', function (UsuariosProyectos2 $UsuariosProyectos2) {
return $UsuariosProyectos2->idproyecto;
})
->editColumn('idcliente', function (UsuariosProyectos2 $UsuariosProyectos2) {
return $UsuariosProyectos2->idcliente;
})
->editColumn('fechac', function (UsuariosProyectos2 $UsuariosProyectos2) {
return $UsuariosProyectos2->fechac;
})

            
            ->addColumn('action', function (UsuariosProyectos2 $UsuariosProyectos2) {
                return view('cruds/UsuariosProyectos2.columns._actions', compact('UsuariosProyectos2'));
            })
            ->setRowId('idusuarioproyecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(UsuariosProyectos2 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('UsuariosProyectos2-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/UsuariosProyectos2/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idusuarioproyecto'),
Column::make('idusuario'),
Column::make('idproyecto'),
Column::make('idcliente'),
Column::make('fechac'),

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
        return 'UsuariosProyectos2_' . date('YmdHis');
    }
}
