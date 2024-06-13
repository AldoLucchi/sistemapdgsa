<?php

namespace App\DataTables;

use App\Models\Users5;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Users5DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function (Users5 $Users5) {
return $Users5->id;
})
->editColumn('name', function (Users5 $Users5) {
return $Users5->name;
})
->editColumn('email', function (Users5 $Users5) {
return $Users5->email;
})
->editColumn('password', function (Users5 $Users5) {
return "---";
})
->editColumn('idcliente', function (Users5 $Users5) {
return $Users5->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Users5 $Users5) {
return $Users5->nombre;
})
->editColumn('apellido', function (Users5 $Users5) {
return $Users5->apellido;
})
->editColumn('cedula', function (Users5 $Users5) {
return $Users5->cedula;
})
->editColumn('movilpersonal', function (Users5 $Users5) {
return $Users5->movilpersonal;
})
->editColumn('movilempresa', function (Users5 $Users5) {
return $Users5->movilempresa;
})
->editColumn('observaciones', function (Users5 $Users5) {
return $Users5->observaciones;
})
->editColumn('idestatus', function (Users5 $Users5) {
return $Users5->UsuariosEstatus->first()?->estatus;
})
->editColumn('idrol', function (Users5 $Users5) {
return $Users5->UsuariosRoles->first()?->rol;
})

            
            ->addColumn('action', function (Users5 $Users5) {
                return view('cruds/Users5.columns._actions', compact('Users5'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Users5 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Users5-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Users5/columns/_draw-scripts.js')) . "}");
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
Column::make('idcliente'),
Column::make('nombre'),
Column::make('apellido'),
Column::make('cedula'),
Column::make('movilpersonal'),
Column::make('movilempresa'),
Column::make('observaciones'),
Column::make('idestatus'),
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
        return 'Users5_' . date('YmdHis');
    }
}
