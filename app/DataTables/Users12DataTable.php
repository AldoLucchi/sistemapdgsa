<?php

namespace App\DataTables;

use App\Models\Users12;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Users12DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function (Users12 $Users12) {
return $Users12->id;
})
->editColumn('name', function (Users12 $Users12) {
return $Users12->name;
})
->editColumn('email', function (Users12 $Users12) {
return $Users12->email;
})
->editColumn('profile_photo_path', function (Users12 $Users12) {
return $Users12->profile_photo_path;
})
->editColumn('email_verified_at', function (Users12 $Users12) {
return $Users12->email_verified_at;
})
->editColumn('password', function (Users12 $Users12) {
return "---";
})
->editColumn('avatar', function (Users12 $Users12) {
return $Users12->avatar;
})
->editColumn('idcliente', function (Users12 $Users12) {
return $Users12->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Users12 $Users12) {
return $Users12->nombre;
})
->editColumn('apellido', function (Users12 $Users12) {
return $Users12->apellido;
})
->editColumn('cedula', function (Users12 $Users12) {
return $Users12->cedula;
})
->editColumn('movilpersonal', function (Users12 $Users12) {
return $Users12->movilpersonal;
})
->editColumn('movilempresa', function (Users12 $Users12) {
return $Users12->movilempresa;
})
->editColumn('foto', function (Users12 $Users12) {
return $Users12->foto;
})
->editColumn('firma', function (Users12 $Users12) {
return $Users12->firma;
})
->editColumn('observaciones', function (Users12 $Users12) {
return $Users12->observaciones;
})
->editColumn('idestatus', function (Users12 $Users12) {
return $Users12->UsuariosEstatus->first()?->estatus;
})
->editColumn('insertar', function (Users12 $Users12) {
return ($Users12->insertar?"ON":"OFF");
})
->editColumn('editar', function (Users12 $Users12) {
return ($Users12->editar?"ON":"OFF");
})
->editColumn('listar', function (Users12 $Users12) {
return ($Users12->listar?"ON":"OFF");
})
->editColumn('eliminar', function (Users12 $Users12) {
return ($Users12->eliminar?"ON":"OFF");
})
->editColumn('imprimir', function (Users12 $Users12) {
return ($Users12->imprimir?"ON":"OFF");
})
->editColumn('admin', function (Users12 $Users12) {
return $Users12->admin;
})
->editColumn('idrol', function (Users12 $Users12) {
return $Users12->UsuariosRoles->first()?->rol;
})
->editColumn('codigocrm', function (Users12 $Users12) {
return $Users12->codigocrm;
})

            
            ->addColumn('action', function (Users12 $Users12) {
                return view('cruds/Users12.columns._actions', compact('Users12'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Users12 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Users12-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Users12/columns/_draw-scripts.js')) . "}");
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
Column::make('profile_photo_path'),
Column::make('email_verified_at'),
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
        return 'Users12_' . date('YmdHis');
    }
}
