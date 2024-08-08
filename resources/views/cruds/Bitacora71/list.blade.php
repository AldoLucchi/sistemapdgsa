<x-default-layout>

    @section('title')
    <a href="{{ url('/admin/bitacora') }}">
        Bitácoras
    </a>
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">

            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-Bitacora71-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="collapse" href="#filtros" role="button" aria-expanded="false" aria-controls="filtros">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Filtros
                    </button>
                    <!--end::Filter-->

                    <!--begin::Add Bitacora71-->
                    <a href="{{ url('/admin/bitacora').'/create'  }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Bitácora
                    </a>
                    <!--end::Add Bitacora71-->
                </div>
                <!--end::Toolbar-->


            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <div class="row border-0 pt-6 collapse  card-filtros " id="filtros">

            <div class="col-12 col-lg-4">
                <label for="texto" class=" form-label">Texto</label>
                <input type="text" class="form-control form-control-transparent" id="texto" name="texto" value="{{ (isset($texto))?$texto:'' }}" />
            </div>

            <div class="col-12 col-lg-4">
                <label for="CrudsGenerados" class=" form-label">CrudsGenerados</label>
                <select class="form-control form-select form-select-transparent" aria-label="Select example" id="CrudsGenerados" name="CrudsGenerados">
                    <option value="">---</option>
                    @foreach($CrudsGeneradosList as $CrudsGeneradosOption)
                    <option value="{{ $CrudsGeneradosOption->id }}" {{ (isset($CrudsGenerados) && $CrudsGenerados == $CrudsGeneradosOption->id )?'selected':'' }}>{{ $CrudsGeneradosOption->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4">
                <label for="BitacorasAcciones" class=" form-label">BitacorasAcciones</label>
                <select class="form-control form-select form-select-transparent" aria-label="Select example" id="BitacorasAcciones" name="BitacorasAcciones">
                    <option value="">---</option>
                    @foreach($BitacorasAccionesList as $BitacorasAccionesOption)
                    <option value="{{ $BitacorasAccionesOption->idaccion }}" {{ (isset($BitacorasAcciones) && $BitacorasAcciones == $BitacorasAccionesOption->idaccion )?'selected':'' }}>{{ $BitacorasAccionesOption->accion }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4">
                <label for="Proyectos" class=" form-label">Proyectos</label>
                <select class="form-control form-select form-select-transparent" aria-label="Select example" id="Proyectos" name="Proyectos">
                    <option value="">---</option>
                    @foreach($ProyectosList as $ProyectosOption)
                    <option value="{{ $ProyectosOption->idproyecto }}" {{ (isset($Proyectos) && $Proyectos == $ProyectosOption->idproyecto )?'selected':'' }}>{{ $ProyectosOption->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-lg-4">
                <label for="Clientes" class=" form-label">Clientes</label>
                <select class="form-control form-select form-select-transparent" aria-label="Select example" id="Clientes" name="Clientes">
                    <option value="">---</option>
                    @foreach($ClientesList as $ClientesOption)
                    <option value="{{ $ClientesOption->idcliente }}" {{ (isset($Clientes) && $Clientes == $ClientesOption->idcliente )?'selected':'' }}>{{ $ClientesOption->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-10 col-12 col-lg-6">
                <label for="fechafrom" class="form-label">fecha: desde</label>
                <input type="date" name="fecha_from" id="fecha_from" class="form-select mb-3 mb-lg-0" placeholder="fecha desde" value="{{ (isset($fecha_from))?$fecha_from:'' }}">

            </div>
            <div class="mb-10 col-12 col-lg-6">
                <label for="fecha_to" class="form-label">fecha: hasta</label>
                <input type="date" name="fecha_to" id="fecha_to" class="form-select mb-3 mb-lg-0" placeholder="fecha hasta" value="{{ (isset($fecha_to))?$fecha_to:'' }}">
            </div>


            <div class="col-12">
                <button type="button" class="btn btn-primary float-end" onclick="redirectFiltros()">
                    {!! getIcon('search-list', 'fs-2', '', 'i') !!}
                    Filtrar
                </button>
            </div>

        </div>

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    {{ $dataTable->scripts() }}
    <script>
        var texto = document.getElementById("texto");
        texto.addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                redirectFiltros();
            }
        });

        //filtros
        function redirectFiltros() {
            var urlFilter = "{{ url('/admin/bitacora')  }}" + "?";

            const texto = document.getElementById("texto").value;
            urlFilter = urlFilter + "texto=" + texto + "&";


            const CrudsGenerados = document.getElementById("CrudsGenerados").value;
            urlFilter = urlFilter + "CrudsGenerados=" + CrudsGenerados + "&";

            const BitacorasAcciones = document.getElementById("BitacorasAcciones").value;
            urlFilter = urlFilter + "BitacorasAcciones=" + BitacorasAcciones + "&";

            const Proyectos = document.getElementById("Proyectos").value;
            urlFilter = urlFilter + "Proyectos=" + Proyectos + "&";

            const Clientes = document.getElementById("Clientes").value;
            urlFilter = urlFilter + "Clientes=" + Clientes + "&";

            const fecha_from = document.getElementById("fecha_from").value;
            urlFilter = urlFilter + "fecha_from=" + fecha_from + "&";

            const fecha_to = document.getElementById("fecha_to").value;
            urlFilter = urlFilter + "fecha_to=" + fecha_to + "&";


            window.location.href = urlFilter;
        }
    </script>
    @endpush

</x-default-layout>