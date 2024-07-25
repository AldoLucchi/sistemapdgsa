<?php

namespace App\DataTables;

use App\Models\Accesosdirectos69;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class Accesosdirectos69DataTable extends DataTable
{
    private $filters;
    private $documentos;

    public function __construct(
        $filters = null,
        $documentos = null,
    ) {
        Log::info('Accesosdirectos69DataTable - __construct');

        $this->filters = $filters;
        $this->documentos = $documentos;
        Log::info($this->documentos);

        if ($filters) {
            if (isset($filters['datatable'])) {
                foreach ($filters['datatable'] as $key => $permiso) {
                    Session::put('Accesosdirectos69_' . $key, true);
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
            ->editColumn('titulo', function (Accesosdirectos69 $Accesosdirectos69) {
                return mb_convert_encoding($Accesosdirectos69->titulo, "UTF-8", "UTF-8");
            })
            ->editColumn('icono', function (Accesosdirectos69 $Accesosdirectos69) {
                return new HtmlString('
                    <a href="/images/' . $Accesosdirectos69->icono . '" target="_blank">
                    <img src="/images/' . $Accesosdirectos69->icono . '" border="0" width="40" class="img-rounded" />
                    </a>
                    ');
            })
            ->editColumn('url', function (Accesosdirectos69 $Accesosdirectos69) {
                return mb_convert_encoding($Accesosdirectos69->url, "UTF-8", "UTF-8");
            })->editColumn('idcrud', function (Accesosdirectos69 $Accesosdirectos69) {
                return $Accesosdirectos69->CrudsGenerados->first()?->nombre;
            })

            ->addColumn('action', function (Accesosdirectos69 $Accesosdirectos69) {
                $data = [
                    'Accesosdirectos69' =>  $Accesosdirectos69,
                    'filters' => $this->filters,
                    'documentos' => $this->documentos,
                ];
                return view('cruds/Accesosdirectos69.columns._actions', $data);
            })
            ->setRowId('idaccesodirecto');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Accesosdirectos69 $model): QueryBuilder
    {
        $query = $model->newQuery();



        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT_WS(titulo,' ',icono,' ',url,' ') ) LIKE '%" . $this->filters["texto"] . "%' ");
        }


        if ($this->filters && isset($this->filters["CrudsGenerados"])) {
            $query->where("idcrud", $this->filters["CrudsGenerados"]);
        }

        if ($this->filters && isset($this->filters["idcrud"])) {
            $query->where("idcrud", $this->filters["idcrud"]);
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
            $rutaDatatable = route('admin.Accesosdirectos69DataTable');
            if (isset($this->filters['datatableFilters'])) {
                $dataFilter = $this->filters['datatableFilters'];
            }
        }

        return $this->builder()
            ->setTableId('Accesosdirectos69-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable, null, $dataFilter)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(0)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Accesosdirectos69/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('titulo')->orderable(false),
            Column::make('icono')->orderable(false),
            Column::make('url')->orderable(false),
            Column::make('idcrud')->orderable(false),

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
        return 'Accesosdirectos69_' . date('YmdHis');
    }
}
