<?php

namespace App\DataTables;

use App\Models\Users13;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Users13DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function (Users13 $Users13) {
return $Users13->id;
})
->editColumn('name', function (Users13 $Users13) {
return $Users13->name;
})
->editColumn('email', function (Users13 $Users13) {
return $Users13->email;
})
->editColumn('password', function (Users13 $Users13) {
return "---";
})
->editColumn('avatar', function (Users13 $Users13) {
return $Users13->avatar;
})
->editColumn('idcliente', function (Users13 $Users13) {
return $Users13->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Users13 $Users13) {
return $Users13->nombre;
})
->editColumn('apellido', function (Users13 $Users13) {
return $Users13->apellido;
})
->editColumn('cedula', function (Users13 $Users13) {
return $Users13->cedula;
})
->editColumn('movilpersonal', function (Users13 $Users13) {
return $Users13->movilpersonal;
})
->editColumn('movilempresa', function (Users13 $Users13) {
return $Users13->movilempresa;
})
->editColumn('foto', function (Users13 $Users13) {
return $Users13->foto;
})
->editColumn('firma', function (Users13 $Users13) {
return $Users13->firma;
})
->editColumn('observaciones', function (Users13 $Users13) {
return $Users13->observaciones;
})
->editColumn('idestatus', function (Users13 $Users13) {
return $Users13->UsuariosEstatus->first()?->estatus;
})
->editColumn('insertar', function (Users13 $Users13) {
return ($Users13->insertar?"ON":"OFF");
})
->editColumn('editar', function (Users13 $Users13) {
return ($Users13->editar?"ON":"OFF");
})
->editColumn('listar', function (Users13 $Users13) {
return ($Users13->listar?"ON":"OFF");
})
->editColumn('eliminar', function (Users13 $Users13) {
return ($Users13->eliminar?"ON":"OFF");
})
->editColumn('imprimir', function (Users13 $Users13) {
return ($Users13->imprimir?"ON":"OFF");
})
->editColumn('admin', function (Users13 $Users13) {
return $Users13->admin;
})
->editColumn('idrol', function (Users13 $Users13) {
return $Users13->UsuariosRoles->first()?->rol;
})
->editColumn('codigocrm', function (Users13 $Users13) {
return $Users13->codigocrm;
})

            
            ->addColumn('action', function (Users13 $Users13) {
                return view('cruds/Users13.columns._actions', compact('Users13'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Users13 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Users13-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Users13/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
Column::make('name'),
Column::make('email'),
Column::make('password'),
Column::make('avatar'),
Column::make('idcliente'),
Column::make('nombre'),
Column::make('apellido'),
Column::make('cedula'),
Column::make('movilpersonal'),
Column::make('movilempresa'),
Column::make('foto'),
Column::make('firma'),
Column::make('observaciones'),
Column::make('idestatus'),
Column::make('insertar'),
Column::make('editar'),
Column::make('listar'),
Column::make('eliminar'),
Column::make('imprimir'),
Column::make('admin'),
Column::make('idrol'),
Column::make('codigocrm'),

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
        return 'Users13_' . date('YmdHis');
    }
}
