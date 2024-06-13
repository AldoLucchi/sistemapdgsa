<?php

namespace App\DataTables;

use App\Models\Crud;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class CrudDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->editColumn('id', function (Crud $crud) {
            return $crud->id;
        })
            ->editColumn('nombre', function (Crud $crud) {
                return $crud->nombre;
            })
            ->editColumn('alias_opcion', function (Crud $crud) {
                return $crud->alias_opcion;
            })
            ->editColumn('nombre_componente', function (Crud $crud) {
                return $crud->nombre_componente;
            })
            ->editColumn('estatus', function (Crud $crud) {
                return ($crud->estatus?'ON':'OFF');
            })
            ->editColumn('created_at', function (Crud $crud) {
                return $crud->created_at;
            })
            ->addColumn('action', function (Crud $crud) {
                return view('pages/apps.admin.crud.columns._actions', compact('crud'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Crud $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('crud-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0, 'desc')
            ->drawCallback("function() {" . file_get_contents(resource_path('views/pages/apps/admin/crud/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->name('id'),
            Column::make('nombre')->name('nombre'),
            Column::make('alias_opcion')->name('alias_opcion'),
            Column::make('nombre_componente')->name('nombre_componente'),
            Column::make('estatus')->name('estatus'),
            Column::make('created_at')->title('Created Date')->addClass('text-nowrap'),
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
        return 'Crud_' . date('YmdHis');
    }
}
