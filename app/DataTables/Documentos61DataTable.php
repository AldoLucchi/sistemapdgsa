<?php

namespace App\DataTables;

use App\Models\Documentos61;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class Documentos61DataTable extends DataTable
{
    private $filters;

    public function __construct(
        $filters = null
    ) {
        $this->filters = $filters;

        if ($filters) {
            if (isset($filters['datatable'])) {
                foreach ($filters['datatable'] as $key => $permiso) {
                    Session::put('Documentos61_' . $key, true);
                }
            }
        }
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->editColumn('iddocumento', function (Documentos61 $Documentos61) {
                return mb_convert_encoding($Documentos61->iddocumento, 'UTF-8', 'UTF-8');
            })
            ->editColumn('nombre', function (Documentos61 $Documentos61) {
                return mb_convert_encoding($Documentos61->nombre, 'UTF-8', 'UTF-8');
            })
            ->editColumn('alias', function (Documentos61 $Documentos61) {
                return mb_convert_encoding($Documentos61->alias, 'UTF-8', 'UTF-8');
            })

            ->editColumn('tabla', function (Documentos61 $Documentos61) {
                return mb_convert_encoding($Documentos61->tabla, 'UTF-8', 'UTF-8');
            })


            ->addColumn('action', function (Documentos61 $Documentos61) {
                $data = [
                    'Documentos61' =>  $Documentos61,
                    'filters' => $this->filters,
                ];
                return view('cruds/Documentos61.columns._actions', $data);
            })
            ->setRowId('iddocumento');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Documentos61 $model): QueryBuilder
    {
        $query = $model->newQuery();



        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT_WS(nombre,' ',alias,' ',tabla,' ') ) LIKE '%" . $this->filters["texto"] . "%' ");
        }



        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $rutaDatatable = '';
        $dataFilter = [];
        if (isset($this->filters) && isset($this->filters['rutaDatatable'])) {
            $rutaDatatable = route('admin.Documentos61DataTable');
            if (isset($this->filters['datatableFilters'])) {
                $dataFilter = $this->filters['datatableFilters'];
            }
        }

        return $this->builder()
            ->setTableId('Documentos61-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable, null, $dataFilter)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->pageLength(50)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Documentos61/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('iddocumento')->orderable(false),
            Column::make('nombre')->orderable(false),
            Column::make('alias')->orderable(false),
            Column::make('tabla')->orderable(false),

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
        return 'Documentos61_' . date('YmdHis');
    }
}
