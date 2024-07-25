<x-default-layout>
    @section('title')
    <a href="{{ url('/admin/accesoDirecto')  }}">
        Accesos Directos
    </a>
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
                <div class="d-flex justify-content-end" data-kt-Accesosdirectos69-table-toolbar="base">
                    <!--begin::Add Accesosdirectos69-->

                    @foreach($documentos as $key=> $documento)
                    <a href="{{ url($documento.$Accesosdirectos69->idaccesodirecto ) }}" class="btn btn-secondary mx-5" target="_blank">
                        Pdf: {{ $key }}
                    </a>
                    @endforeach

                    <a href="{{ url('/admin/accesoDirecto').'/create' }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Acceso Directo
                    </a>

                    <!--end::Add Accesosdirectos69-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->


            <div class="accordion" id="accordionAcceso Directo">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelDatos">
                        <button class="accordion-button bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelDatosCollapse" aria-expanded="true" aria-controls="panelDatosCollapse">
                            Datos
                        </button>
                    </h2>
                    <div id="panelDatosCollapse" class="accordion-collapse collapse show" aria-labelledby="panelDatos">
                        <div class="accordion-body">
                            <fieldset id="show-fieldset-Acceso Directo" disabled>
                                <div class="row">
                                    @include('cruds.Accesosdirectos69.fields')
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

    </script>
    @endpush

</x-default-layout>