<x-default-layout>

    @section('title')
    <a href="{{ url('/admin/etiquetaDocumento' ) }}">
        EtiquetasDocumentos
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
                <div class="d-flex justify-content-end" data-kt-EtiquetasDocumentos104-table-toolbar="base">

                    <a href="{{ url('/admin/getEtiquetaDocumento/alias/id' ) }}" class="btn btn-secondary mx-5">
                        Test Link Convert
                    </a>

                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="collapse" href="#filtros" role="button" aria-expanded="false" aria-controls="filtros">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Filtros
                    </button>
                    <!--end::Filter-->

                    <!--begin::Add EtiquetasDocumentos104-->
                    <!--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_EtiquetasDocumentos104">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Etiqueta Documento
                        </button>-->
                    <a href="{{ url('/admin/etiquetaDocumento/create' ) }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Etiqueta Documento
                    </a>
                    <!--end::Add EtiquetasDocumentos104-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:EtiquetasDocumentos104.add-EtiquetasDocumentos104-modal></livewire:EtiquetasDocumentos104.add-EtiquetasDocumentos104-modal>
                <!--end::Modal-->
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
        document.getElementById('mySearchInput').addEventListener('keyup', function() {
            window.LaravelDataTables['EtiquetasDocumentos104-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_EtiquetasDocumentos104').modal('hide');
                window.LaravelDataTables['EtiquetasDocumentos104-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_EtiquetasDocumentos104').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_EtiquetasDocumentos104');
        });

        //filtros
        function redirectFiltros() {
            var urlFilter = "{{ url('/admin/etiquetaDocumento' ) }}" + "?";

            const texto = document.getElementById("texto").value;
            urlFilter = urlFilter + "texto=" + texto + "&";



            window.location.href = urlFilter;
        }
    </script>
    @endpush

</x-default-layout>