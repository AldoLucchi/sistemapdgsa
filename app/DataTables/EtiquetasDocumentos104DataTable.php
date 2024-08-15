<?php

namespace App\DataTables;

use App\Models\EtiquetasDocumentos104;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;

class EtiquetasDocumentos104DataTable extends DataTable
{
    private $filters;

    public function __construct(
        $filters = null
    ) {
        $this->filters = $filters;

        if ($filters) {
            if (isset($filters['datatable'])) { 
                foreach($filters['datatable'] as $key =>$permiso){
                    Session::put('EtiquetasDocumentos104_'.$key, true);
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
            ->editColumn('idetiquetadocumento', function (EtiquetasDocumentos104 $EtiquetasDocumentos104) {
return mb_convert_encoding($EtiquetasDocumentos104->idetiquetadocumento, 'UTF-8', 'UTF-8') ;
})
->editColumn('alias', function (EtiquetasDocumentos104 $EtiquetasDocumentos104) {
return mb_convert_encoding($EtiquetasDocumentos104->alias, 'UTF-8', 'UTF-8') ;
})
->editColumn('tabla', function (EtiquetasDocumentos104 $EtiquetasDocumentos104) {
return mb_convert_encoding($EtiquetasDocumentos104->tabla, 'UTF-8', 'UTF-8') ;
})
->editColumn('campo', function (EtiquetasDocumentos104 $EtiquetasDocumentos104) {
return mb_convert_encoding($EtiquetasDocumentos104->campo, 'UTF-8', 'UTF-8') ;
})

            
            ->addColumn('action', function (EtiquetasDocumentos104 $EtiquetasDocumentos104) {
                $data = [
                    'EtiquetasDocumentos104' =>  $EtiquetasDocumentos104,
                    'filters' => $this->filters,
                ];
                return view('cruds/EtiquetasDocumentos104.columns._actions', $data);
            })
            ->setRowId('idetiquetadocumento');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(EtiquetasDocumentos104 $model): QueryBuilder
    {
        $query = $model->newQuery();

        

        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT(alias,' ',tabla,' ',campo,' ') ) LIKE '%". $this->filters["texto"]."%' ");
        }

        

        return $query;
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $rutaDatatable = '';
        if( isset( $this->filters) && isset( $this->filters['rutaDatatable'])){
            $rutaDatatable = route('admin.etiquetaDocumentoDataTable');
        }

        return $this->builder()
            ->setTableId('EtiquetasDocumentos104-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->pageLength(100)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/EtiquetasDocumentos104/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idetiquetadocumento')->orderable(false),
Column::make('alias')->orderable(false),
Column::make('tabla')->orderable(false),
Column::make('campo')->orderable(false),

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
        return 'EtiquetasDocumentos104_' . date('YmdHis');
    }
}
