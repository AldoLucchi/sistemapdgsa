<?php

namespace App\DataTables;

use App\Models\MenuesAsignados101;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class MenuesAsignados101DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idnmenuasignado', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->idnmenuasignado;
})
->editColumn('idmenu', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->Menues->first()?->menu;
})
->editColumn('idcliente', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->Clientes->first()?->nombre;
})
->editColumn('idrol', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->UsuariosRoles->first()?->rol;
})
->editColumn('estatus', function (MenuesAsignados101 $MenuesAsignados101) {
return ($MenuesAsignados101->estatus?"ON":"OFF");
})
->editColumn('idproyecto', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->Proyectos->first()?->nombre;
})
->editColumn('posicion', function (MenuesAsignados101 $MenuesAsignados101) {
return $MenuesAsignados101->posicion;
})

            
            ->addColumn('action', function (MenuesAsignados101 $MenuesAsignados101) {
                return view('cruds/MenuesAsignados101.columns._actions', compact('MenuesAsignados101'));
            })
            ->setRowId('idnmenuasignado');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(MenuesAsignados101 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('MenuesAsignados101-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/MenuesAsignados101/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idnmenuasignado'),
Column::make('idmenu'),
Column::make('idcliente'),
Column::make('idrol'),
Column::make('estatus'),
Column::make('idproyecto'),
Column::make('posicion'),

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
        return 'MenuesAsignados101_' . date('YmdHis');
    }
}
