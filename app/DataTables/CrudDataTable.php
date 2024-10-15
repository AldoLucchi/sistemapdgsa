<?php

namespace App\DataTables;

use App\Models\Crud;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\HtmlString;

class CrudDataTable extends DataTable
{
    //protected $tables;

    public function __construct(
        $tables = null,
    ) {
        Log::info('CrudDataTable - __construct');

        //$this->tables = $tables;
        //Log::info($this->tables);
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $cruds = Crud::where('estatus', 1)->get();

        return (new EloquentDataTable($query))
            ->editColumn('id', function (Crud $crud) {
                return  mb_convert_encoding($crud->id, 'UTF-8', 'UTF-8');
            })
            ->editColumn('nombre', function (Crud $crud) {
                return mb_convert_encoding($crud->nombre, 'UTF-8', 'UTF-8');
            })
            ->editColumn('alias_opcion', function (Crud $crud) {
                return mb_convert_encoding($crud->alias_opcion, 'UTF-8', 'UTF-8');
            })
            ->editColumn('nombre_componente', function (Crud $crud) {
                return new HtmlString('<a href="/crud/' . $crud->nombre_componente . '" target="_blank">' . $crud->nombre_componente . ' </a>');
            })
            ->editColumn('estatus', function (Crud $crud) {
                return   mb_convert_encoding(($crud->estatus ? 'ON' : 'OFF'), 'UTF-8', 'UTF-8');
            })
            ->editColumn('crud_accordion_incluido_en', function (Crud $crud) {
                $accordions = '';

                $campos_array = json_decode($crud->campos);
                if ($campos_array) {
                    foreach ($campos_array as $campo) {
                        if ($campo->show_fk) {
                            $crud_accordion = Crud::find($campo->show_fk);
                            if ($crud_accordion) {
                                $accordions .= $crud_accordion->nombre_componente . ', ';
                            }
                        }
                    }
                }


                return mb_convert_encoding($accordions, 'UTF-8', 'UTF-8');
            })
            ->editColumn('accordions_incluidos', function (Crud $crud) use ($cruds) {
                $accordions = '';
                foreach ($cruds as $crud_generado) {
                    $campos_array = json_decode($crud_generado->campos);
                    if ($campos_array) {
                        foreach ($campos_array as $campo) {
                            if ($campo->show_fk && $campo->show_fk == $crud->id) {
                                $accordions .= $crud_generado->nombre_componente . ', ';
                            }
                        }
                    }
                }

                return mb_convert_encoding($accordions, 'UTF-8', 'UTF-8');
            })
            ->editColumn('created_at', function (Crud $crud) {
                return mb_convert_encoding($crud->created_at, 'UTF-8', 'UTF-8');
            })
            ->addColumn('action', function (Crud $crud) {
                return view('admin.crud.columns._actions', compact('crud'));
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
        $pageLength = env('PAGINATE_QUANTITY', 10);
        return $this->builder()
            ->setTableId('crud-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->pageLength($pageLength)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/admin/crud/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->title('id'),
            Column::make('nombre')->title('nombre'),
            Column::make('alias_opcion')->title('alias opcion'),
            Column::make('nombre_componente')->title('nombre componente'),
            Column::make('estatus')->title('estatus'),
            Column::make('crud_accordion_incluido_en')->title('crud accordion incluido en')->orderable(false),
            Column::make('accordions_incluidos')->title('accordions incluidos')->orderable(false),
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
