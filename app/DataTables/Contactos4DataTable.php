<?php

namespace App\DataTables;

use App\Models\Contactos4;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class Contactos4DataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('idcontacto', function (Contactos4 $Contactos4) {
return $Contactos4->idcontacto;
})
->editColumn('nombre', function (Contactos4 $Contactos4) {
return $Contactos4->nombre;
})
->editColumn('telefono', function (Contactos4 $Contactos4) {
return $Contactos4->telefono;
})
->editColumn('celular', function (Contactos4 $Contactos4) {
return $Contactos4->celular;
})
->editColumn('whatsapp', function (Contactos4 $Contactos4) {
return $Contactos4->whatsapp;
})
->editColumn('otrotelefono', function (Contactos4 $Contactos4) {
return $Contactos4->otrotelefono;
})
->editColumn('correo', function (Contactos4 $Contactos4) {
return $Contactos4->correo;
})
->editColumn('idorigendatos', function (Contactos4 $Contactos4) {
return $Contactos4->ContactosOrigenesdedatos->first()?->origendedato;
})
->editColumn('fechanacimiento', function (Contactos4 $Contactos4) {
return $Contactos4->fechanacimiento;
})
->editColumn('idestadocivil', function (Contactos4 $Contactos4) {
return $Contactos4->ContactosEstadocivil->first()?->estadocivil;
})
->editColumn('ingresofamiliar', function (Contactos4 $Contactos4) {
return $Contactos4->ingresofamiliar;
})
->editColumn('idprovincia', function (Contactos4 $Contactos4) {
return $Contactos4->ContactosProvincias->first()?->provincia;
})
->editColumn('idformacontacto', function (Contactos4 $Contactos4) {
return $Contactos4->ContactosFormascontacto->first()?->formacontacto;
})
->editColumn('horario', function (Contactos4 $Contactos4) {
return $Contactos4->horario;
})
->editColumn('idvendedor', function (Contactos4 $Contactos4) {
return $Contactos4->Users->first()?->name;
})
->editColumn('idpaso', function (Contactos4 $Contactos4) {
return $Contactos4->Pasos->first()?->paso;
})

            
            ->addColumn('action', function (Contactos4 $Contactos4) {
                return view('cruds/Contactos4.columns._actions', compact('Contactos4'));
            })
            ->setRowId('idcontacto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Contactos4 $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('Contactos4-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(2)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Contactos4/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idcontacto'),
Column::make('nombre'),
Column::make('telefono'),
Column::make('celular'),
Column::make('whatsapp'),
Column::make('otrotelefono'),
Column::make('correo'),
Column::make('idorigendatos'),
Column::make('fechanacimiento'),
Column::make('idestadocivil'),
Column::make('ingresofamiliar'),
Column::make('idprovincia'),
Column::make('idformacontacto'),
Column::make('horario'),
Column::make('idvendedor'),
Column::make('idpaso'),

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
        return 'Contactos4_' . date('YmdHis');
    }
}
