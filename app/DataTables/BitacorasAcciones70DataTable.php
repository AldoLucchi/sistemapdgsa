<?php

namespace App\DataTables;

use App\Models\BitacorasAcciones70;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class BitacorasAcciones70DataTable extends DataTable
{
    protected $filters;
    protected $documentos;

    public function __construct(
        $filters = null,
        $documentos = null,
    ) {
        Log::info('BitacorasAcciones70DataTable - __construct');

        $this->filters = $filters;
        $this->documentos = $documentos;
        Log::info($this->documentos);

        if ($filters) {
            if (isset($filters['datatable'])) { 
                foreach($filters['datatable'] as $key =>$permiso){
                    Session::put('BitacorasAcciones70_'.$key, true);
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
        Log::info($this->documentos);

        return (new EloquentDataTable($query))
            ->editColumn('idaccion', function (BitacorasAcciones70 $BitacorasAcciones70) {
return mb_convert_encoding( $BitacorasAcciones70->idaccion, "UTF-8", "UTF-8") ;
})->editColumn('accion', function (BitacorasAcciones70 $BitacorasAcciones70) {
return mb_convert_encoding( $BitacorasAcciones70->accion, "UTF-8", "UTF-8") ;
})
            
            ->addColumn('action', function (BitacorasAcciones70 $BitacorasAcciones70) {
                $data = [
                    'BitacorasAcciones70' =>  $BitacorasAcciones70,
                    'filters' => $this->filters,
                    'documentos' => $this->documentos,
                ];
                return view('cruds/BitacorasAcciones70.columns._actions', $data);
            })
            ->setRowId('idaccion');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(BitacorasAcciones70 $model): QueryBuilder
    {
        $query = $model->newQuery();

        

        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT_WS(accion,' ') ) LIKE '%". $this->filters["texto"]."%' ");
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
        if( isset( $this->filters) && isset( $this->filters['rutaDatatable'])){
            $rutaDatatable = route('admin.BitacorasAcciones70DataTable');
            if(isset( $this->filters['datatableFilters']) ){
            $dataFilter = $this->filters['datatableFilters'];
            }
        }

        return $this->builder()
            ->setTableId('BitacorasAcciones70-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable, null, $dataFilter)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->pageLength(100)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/BitacorasAcciones70/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idaccion')->orderable(false),
Column::make('accion')->orderable(false),

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
        return 'BitacorasAcciones70_' . date('YmdHis');
    }
}
