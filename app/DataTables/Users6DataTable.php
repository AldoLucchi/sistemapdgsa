<?php

namespace App\DataTables;

use App\Models\Users6;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Users6DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function (Users6 $Users6) {
return $Users6->id;
})
->editColumn('name', function (Users6 $Users6) {
return $Users6->name;
})
->editColumn('email', function (Users6 $Users6) {
return $Users6->email;
})
->editColumn('password', function (Users6 $Users6) {
return ---;
})
->editColumn('idcliente', function (Users6 $Users6) {
return $Users6->Clientes->first()?->nombre;
})
->editColumn('nombre', function (Users6 $Users6) {
return $Users6->nombre;
})
->editColumn('apellido', function (Users6 $Users6) {
return $Users6->apellido;
})
->editColumn('cedula', function (Users6 $Users6) {
return $Users6->cedula;
})
->editColumn('movilpersonal', function (Users6 $Users6) {
return $Users6->movilpersonal;
})
->editColumn('movilempresa', function (Users6 $Users6) {
return $Users6->movilempresa;
})

            
            ->addColumn('action', function (Users6 $Users6) {
                return view('cruds/Users6.columns._actions', compact('Users6'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Users6 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Users6-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Users6/columns/_draw-scripts.js')) . "}");
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
        return 'Users6_' . date('YmdHis');
    }
}
