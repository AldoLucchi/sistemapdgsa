<?php

namespace App\DataTables;

use App\Models\Proyectos14;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Proyectos14DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idproyecto', function (Proyectos14 $Proyectos14) {
return $Proyectos14->idproyecto;
})
->editColumn('nombre', function (Proyectos14 $Proyectos14) {
return $Proyectos14->nombre;
})
->editColumn('idcliente', function (Proyectos14 $Proyectos14) {
return $Proyectos14->Clientes->first()?->nombre;
})
->editColumn('idusuario', function (Proyectos14 $Proyectos14) {
return $Proyectos14->Usuarios->first()?->idcliente;
})
->editColumn('logo', function (Proyectos14 $Proyectos14) {
return $Proyectos14->logo;
})
->editColumn('direccion', function (Proyectos14 $Proyectos14) {
return $Proyectos14->direccion;
})
->editColumn('idestatus', function (Proyectos14 $Proyectos14) {
return $Proyectos14->UsuariosEstatus->first()?->estatus;
})
->editColumn('identificadorcontrato', function (Proyectos14 $Proyectos14) {
return $Proyectos14->identificadorcontrato;
})
->editColumn('idconstructora', function (Proyectos14 $Proyectos14) {
return $Proyectos14->idconstructora;
})
->editColumn('fincamadre', function (Proyectos14 $Proyectos14) {
return $Proyectos14->fincamadre;
})
->editColumn('codigoubicacion', function (Proyectos14 $Proyectos14) {
return $Proyectos14->codigoubicacion;
})
->editColumn('codigocrm', function (Proyectos14 $Proyectos14) {
return $Proyectos14->codigocrm;
})

            
            ->addColumn('action', function (Proyectos14 $Proyectos14) {
                return view('cruds/Proyectos14.columns._actions', compact('Proyectos14'));
            })
            ->setRowId('idproyecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Proyectos14 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Proyectos14-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Proyectos14/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idproyecto'),
Column::make('nombre'),
Column::make('idcliente'),
Column::make('idusuario'),
Column::make('logo'),
Column::make('direccion'),
Column::make('idestatus'),
Column::make('identificadorcontrato'),
Column::make('idconstructora'),
Column::make('fincamadre'),
Column::make('codigoubicacion'),
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
        return 'Proyectos14_' . date('YmdHis');
    }
}
