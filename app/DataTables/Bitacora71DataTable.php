<?php

namespace App\DataTables;

use App\Models\Bitacora71;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class Bitacora71DataTable extends DataTable
{
    protected $filters;
    protected $documentos;

    public function __construct(
        $filters = null,
        $documentos = null,
    ) {
        Log::info('Bitacora71DataTable - __construct');

        $this->filters = $filters;
        $this->documentos = $documentos;
        Log::info($this->documentos);

        if ($filters) {
            if (isset($filters['datatable'])) {
                foreach ($filters['datatable'] as $key => $permiso) {
                    Session::put('Bitacora71_' . $key, true);
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
            ->editColumn('idbitacora', function (Bitacora71 $Bitacora71) {
                return mb_convert_encoding($Bitacora71->idbitacora, "UTF-8", "UTF-8");
            })->editColumn('crud', function (Bitacora71 $Bitacora71) {
                return mb_convert_encoding($Bitacora71->crud, "UTF-8", "UTF-8");
            })->editColumn('tabla', function (Bitacora71 $Bitacora71) {
                return mb_convert_encoding($Bitacora71->tabla, "UTF-8", "UTF-8");
            })->editColumn('id', function (Bitacora71 $Bitacora71) {
                return mb_convert_encoding($Bitacora71->id, "UTF-8", "UTF-8");
            })->editColumn('idaccion', function (Bitacora71 $Bitacora71) {
                return $Bitacora71->BitacorasAcciones->first()?->accion;
            })->editColumn('idusuario', function (Bitacora71 $Bitacora71) {
                $username = '';
                $user = $Bitacora71->Users->first();
                if($user){
                    $username = $user->name.' '.$user->apellido;
                }
                return $username;
            })->editColumn('fecha', function (Bitacora71 $Bitacora71) {
                return mb_convert_encoding($Bitacora71->fecha, "UTF-8", "UTF-8");
            })

            ->addColumn('action', function (Bitacora71 $Bitacora71) {
                $data = [
                    'Bitacora71' =>  $Bitacora71,
                    'filters' => $this->filters,
                    'documentos' => $this->documentos,
                ];
                return view('cruds/Bitacora71.columns._actions', $data);
            })
            ->setRowId('idbitacora');
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Bitacora71 $model): QueryBuilder
    {
        $query = $model->newQuery();

        /*
        if (Session::has('idproyecto') && Session::get('idproyecto')) {
            $query->where('idproyecto', Session::get('idproyecto'));
        }
        if (Session::has('idcliente') && Session::get('idcliente')) {
            $query->where('idcliente', Session::get('idcliente'));
        }
        */


        if ($this->filters && isset($this->filters["texto"])) {
            $this->filters["texto"] = strtolower($this->filters["texto"]);
            $query->whereRaw("LOWER( CONCAT_WS(tabla,' ',campoid,' ',descripcion,' ',ip,' ') ) LIKE '%" . $this->filters["texto"] . "%' ");
        }


        if ($this->filters && isset($this->filters["CrudsGenerados"])) {
            $query->where("idcrud", $this->filters["CrudsGenerados"]);
        }

        if ($this->filters && isset($this->filters["idcrud"])) {
            $query->where("idcrud", $this->filters["idcrud"]);
        }

        if ($this->filters && isset($this->filters["BitacorasAcciones"])) {
            $query->where("idaccion", $this->filters["BitacorasAcciones"]);
        }

        if ($this->filters && isset($this->filters["idaccion"])) {
            $query->where("idaccion", $this->filters["idaccion"]);
        }

        if ($this->filters && isset($this->filters["Proyectos"])) {
            $query->where("idproyecto", $this->filters["Proyectos"]);
        }

        if ($this->filters && isset($this->filters["idproyecto"])) {
            $query->where("idproyecto", $this->filters["idproyecto"]);
        }

        if ($this->filters && isset($this->filters["Clientes"])) {
            $query->where("idcliente", $this->filters["Clientes"]);
        }

        if ($this->filters && isset($this->filters["idcliente"])) {
            $query->where("idcliente", $this->filters["idcliente"]);
        }

        if ($this->filters && isset($this->filters["fecha_from"])) {
            $query->where("fecha", ">",  $this->filters["fecha_from"]);
        }

        if ($this->filters && isset($this->filters["fecha_to"])) {
            $query->where("fecha", "<",  $this->filters["fecha_to"]);
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
            $rutaDatatable = route('admin.Bitacora71DataTable');
            if (isset($this->filters['datatableFilters'])) {
                $dataFilter = $this->filters['datatableFilters'];
            }
        }

        $pageLength = env('PAGINATE_QUANTITY',10);

        return $this->builder()
            ->setTableId('Bitacora71-table')
            ->columns($this->getColumns())
            ->minifiedAjax($rutaDatatable, null, $dataFilter)
            ->dom('rt' . "<'row'<'col-sm-12 col-md-5'l><'col-sm-12 col-md-7'p>>",)
            ->addTableClass('table align-middle table-row-dashed fs-6 gy-5 dataTable no-footer text-gray-600 fw-semibold')
            ->setTableHeadClass('text-start text-muted fw-bold fs-7 text-uppercase gs-0')
            ->orderBy(6, 'desc')
            ->pageLength($pageLength)
            ->drawCallback("function() {" . file_get_contents(resource_path('views/cruds/Bitacora71/columns/_draw-scripts.js')) . "}");
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('idbitacora')->orderable(true),
            Column::make('crud')->orderable(true),
            Column::make('tabla')->orderable(true),
            Column::make('id')->orderable(true),
            Column::make('idaccion')->orderable(true),
            Column::make('idusuario')->orderable(true),
            Column::make('fecha')->orderable(true),

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
        return 'Bitacora71_' . date('YmdHis');
    }
}
