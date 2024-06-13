<?php

namespace App\DataTables;

use App\Models\Usuarios1;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Usuarios1DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idcliente', function (Usuarios1 $Usuarios1) {
return $Usuarios1->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Usuarios1 $Usuarios1) {
return $Usuarios1->nombre;
})
->editColumn('apellido', function (Usuarios1 $Usuarios1) {
return $Usuarios1->apellido;
})
->editColumn('cedula', function (Usuarios1 $Usuarios1) {
return $Usuarios1->cedula;
})
->editColumn('movilpersonal', function (Usuarios1 $Usuarios1) {
return $Usuarios1->movilpersonal;
})
->editColumn('movilempresa', function (Usuarios1 $Usuarios1) {
return $Usuarios1->movilempresa;
})
->editColumn('foto', function (Usuarios1 $Usuarios1) {
return $Usuarios1->foto;
})
->editColumn('correo', function (Usuarios1 $Usuarios1) {
return $Usuarios1->correo;
})
->editColumn('clave', function (Usuarios1 $Usuarios1) {
return $Usuarios1->clave;
})
->editColumn('firma', function (Usuarios1 $Usuarios1) {
return $Usuarios1->firma;
})
->editColumn('observaciones', function (Usuarios1 $Usuarios1) {
return $Usuarios1->observaciones;
})
->editColumn('idestatus', function (Usuarios1 $Usuarios1) {
return $Usuarios1->UsuariosEstatus->first()?->estatus;
})
->editColumn('admin', function (Usuarios1 $Usuarios1) {
return $Usuarios1->UsuariosEstatus->first()?->estatus;
})
->editColumn('idrol', function (Usuarios1 $Usuarios1) {
return $Usuarios1->UsuariosRoles->first()?->rol;
})

            
            ->addColumn('action', function (Usuarios1 $Usuarios1) {
                return view('cruds/Usuarios1.columns._actions', compact('Usuarios1'));
            })
            ->setRowId('idusuario');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Usuarios1 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Usuarios1-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Usuarios1/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idcliente'),
Column::make('nombre'),
Column::make('apellido'),
Column::make('cedula'),
Column::make('movilpersonal'),
Column::make('movilempresa'),
Column::make('foto'),
Column::make('correo'),
Column::make('clave'),
Column::make('firma'),
Column::make('observaciones'),
Column::make('idestatus'),
Column::make('admin'),
Column::make('idrol'),

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
        return 'Usuarios1_' . date('YmdHis');
    }
}
