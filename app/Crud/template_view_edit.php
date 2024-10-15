<x-default-layout>
    @inject('auxiliarService', 'App\Services\AuxiliarService')

    @section('title')
    <a href="{{ url('/'. (Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%') ) }}">
        Listado: %OBJETO_LABEL_ALIAS%
    </a>
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                Editar {{ $%OBJETO%->%FIELD_NAME% }}
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
                    <!--end::Add %OBJETO_ROUTE%-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <!--end::Modal-->
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
                    <div id="panelDatosCollapse" class="accordion-collapse " aria-labelledby="panelDatos">
                        <div class="accordion-body">


                            <form id="edit_%OBJETO_ROUTE%_form" name="edit_%OBJETO_ROUTE%_form" class="form" action="{{ route('crud.%OBJETO_ROUTE%.update', $%OBJETO_ROUTE%) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    @include('cruds.%OBJETO_VIEW%.fields')
                                </div>

                                <div class="row">
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" name="guardar" class="btn btn-primary mx-5" value="1">Guardar</button>
                                        <button type="submit" name="guardar_permanecer" class="btn btn-primary" value="1">Guardar y permanecer</button>
                                    </div>
                                </div>
                            </form>
                            <!--end::Table-->

                        </div>
                    </div>
                </div>

                <!-- %RELATIONS_DATATABLE_1% -->

                <!-- %RELATIONS_DATATABLE_2% -->                

                <!-- %RELATIONS_DATATABLE_3% -->                

                <!-- %RELATIONS_DATATABLE_4% -->
                 
                <!-- %RELATIONS_DATATABLE_5% -->
                 
                <!-- %RELATIONS_DATATABLE_6% -->
                 
                <!-- %RELATIONS_DATATABLE_7% -->
                 
                <!-- %RELATIONS_DATATABLE_8% -->
                 
                <!-- %RELATIONS_DATATABLE_9% -->                

                <!-- %RELATIONS_DATATABLE% -->   

            </div>
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')

    <!-- %RELATIONS_DATATABLE_SCRIPTS_1% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_2% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_3% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_4% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_5% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_6% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_7% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_8% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS_9% -->

    <!-- %RELATIONS_DATATABLE_SCRIPTS% -->

    @include('cruds.%OBJETO_VIEW%.scripts')
    @endpush

</x-default-layout>