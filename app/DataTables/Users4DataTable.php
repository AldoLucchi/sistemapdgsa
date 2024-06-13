<?php

namespace App\DataTables;

use App\Models\Users4;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Users4DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('id', function (Users4 $Users4) {
return $Users4->id;
})
->editColumn('name', function (Users4 $Users4) {
return $Users4->name;
})
->editColumn('email', function (Users4 $Users4) {
return $Users4->email;
})
->editColumn('password', function (Users4 $Users4) {
return "---";
})
->editColumn('idcliente', function (Users4 $Users4) {
return $Users4->Clientes->first()?->nombre;
})

            
            ->addColumn('action', function (Users4 $Users4) {
                return view('cruds/Users4.columns._actions', compact('Users4'));
            })
            ->setRowId('id');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Users4 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Users4-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Users4/columns/_draw-scripts.js')) . "}");
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
        return 'Users4_' . date('YmdHis');
    }
}
