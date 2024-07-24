<?php

namespace App\DataTables;

use App\Models\%OBJETO%;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class %OBJETO_DATATABLE% extends DataTable
{
    private $filters;

    public function __construct(
        $filters = null
    ) {
        $this->filters = $filters;

        if ($filters) {
            if (isset($filters['datatable'])) { 
                foreach($filters['datatable'] as $key =>$permiso){
                    Session::put('%OBJETO%_'.$key, true);
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
            %FIELDS_DATATABLES_DATATABLE%
            
            ->addColumn('action', function (%OBJETO% $%OBJETO_VARIABLE%) {
                $data = [
                    '%OBJETO_VARIABLE%' =>  $%OBJETO_VARIABLE%,
                    'filters' => $this->filters,
                ];
                return view('cruds/%OBJETO_VIEW%.columns._actions', $data);
            })
            ->setRowId('%FIELD_ID%');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(%OBJETO% $model): QueryBuilder
    {
        $query = $model->newQuery();

        %DATATABLE_QUERY_FILTERS%

        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT_WS(%DATATABLE_QUERY_FILTERS_DYNAMIC_TEXTO%) ) LIKE '%". $this->filters["texto"]."%' ");
        }

        %DATATABLE_QUERY_FILTERS_DYNAMIC%

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $rutaDatatable = '';
        $dataFilter = [];
        if( isset( $this->filters) && isset( $this->filters['rutaDatatable'])){
            $rutaDatatable = route('crud.%OBJETO_VARIABLE%DataTable');
            if(isset( $this->filters['datatableFilters']) ){
            $dataFilter = $this->filters['datatableFilters'];
            }
        }

        return $this->builder()
            ->setTableId('%OBJETO_VARIABLE%-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable, null, $dataFilter)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/%OBJETO_VIEW%/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            %FIELDS_DATATABLES_GETCOLUMNS%
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
        return '%OBJETO%_' . date('YmdHis');
    }
}
