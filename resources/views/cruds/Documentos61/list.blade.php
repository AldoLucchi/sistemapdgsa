<x-default-layout>

    @section('title')
    <a href="{{ url('/'. (Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento') ) }}">
        Documentos
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
                <div class="d-flex justify-content-end" data-kt-Documentos61-table-toolbar="base">

                    <a href="{{ url('/generarPdf/idRegister/idDocumento' ) }}" class="btn btn-secondary mx-5">
                        Test Link 
                    </a>

                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="collapse" href="#filtros" role="button" aria-expanded="false" aria-controls="filtros">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Filtros
                    </button>
                    <!--end::Filter-->

                    <!--begin::Add Documentos61-->
                    <a href="{{ url('/'. (Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento').'/create' ) }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Documento
                    </a>
                    <!--end::Add Documentos61-->
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
        //filtros
        function redirectFiltros() {
            var urlFilter = "{{ url('/'.(Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento') ) }}" + "?";

            const texto = document.getElementById("texto").value;
            urlFilter = urlFilter + "texto=" + texto + "&";



            window.location.href = urlFilter;
        }
    </script>
    @endpush

</x-default-layout>