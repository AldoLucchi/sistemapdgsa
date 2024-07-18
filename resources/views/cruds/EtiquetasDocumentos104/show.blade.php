<x-default-layout>
    @section('title')
    EtiquetasDocumentos
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    DETALLE
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-EtiquetasDocumentos104-table-toolbar="base">
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

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->


            <div class="accordion" id="accordionEtiqueta Documento">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelDatos">
                        <button class="accordion-button bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelDatosCollapse" aria-expanded="true" aria-controls="panelDatosCollapse">
                            Datos
                        </button>
                    </h2>
                    <div id="panelDatosCollapse" class="accordion-collapse collapse show" aria-labelledby="panelDatos">
                        <div class="accordion-body">
                            <fieldset id="show-fieldset-Etiqueta Documento" disabled>
                                <div class="row">
                                    @include('cruds.EtiquetasDocumentos104.fields')
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>

                <!-- %RELATIONS_DATATABLE% -->

            </div>

            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')

    <!-- %RELATIONS_DATATABLE_SCRIPTS% -->

    <script>
        $('#kt_modal_add_usuarios').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_usuarios');
        });
    </script>
    @endpush

</x-default-layout>