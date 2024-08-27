<x-default-layout>
    @inject('auxiliarService', 'App\Services\AuxiliarService')

    @section('title')
    <a href="{{ url('/'. (Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}">
        %OBJETO_LABEL_ALIAS%
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
                <div class="d-flex justify-content-end" data-kt-%OBJETO_ROUTE%-table-toolbar="base">
                    <!--begin::Add %OBJETO_ROUTE%-->

                    @foreach($documentos as $key=> $documento)
                    <a href="{{ url($documento.$%OBJETO%->%FIELD_ID% ) }}" class="btn btn-secondary mx-5" target="_blank">
                        Pdf: {{ $key }}
                    </a>
                    @endforeach

                    <a href="{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%').'/'.$%OBJETO%->%FIELD_ID% .'/edit' ) }}" class="btn btn-primary %OBJETO_CREATE%">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Editar %OBJETO_LABEL_INDIVIDUAL%
                    </a>

                    <!--end::Add %OBJETO_ROUTE%-->
                </div>
                <!--end::Toolbar-->

            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->

            <div class="accordion" id="accordion%OBJETO_LABEL_INDIVIDUAL%">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="panelDatos">
                        <button class="accordion-button bg-primary text-white" type="button" data-bs-toggle="collapse" data-bs-target="#panelDatosCollapse" aria-expanded="true" aria-controls="panelDatosCollapse">
                            Datos Generales
                        </button>
                    </h2>
                    <div id="panelDatosCollapse" class="accordion-collapse collapse" aria-labelledby="panelDatos">
                        <div class="accordion-body">
                            <fieldset id="show-fieldset-%OBJETO_LABEL_INDIVIDUAL%" disabled>
                                <div class="row">
                                    @include('cruds.%OBJETO_VIEW%.fields')
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

    @include('cruds.%OBJETO_VIEW%.scripts')
    @endpush

</x-default-layout>