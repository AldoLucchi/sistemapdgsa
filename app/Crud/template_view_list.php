<x-default-layout>

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
                
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-%OBJETO_VIEW%-table-toolbar="base">
                    <!--begin::Filter-->
                    <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="collapse" href="#filtros" role="button" aria-expanded="false" aria-controls="filtros">
                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i>
                        Filtros
                    </button>
                    <!--end::Filter-->

                    <!--begin::Add %OBJETO_VIEW%-->
                    <a href="{{ url('/'. (Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%').'/create' ) }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar %OBJETO_LABEL_INDIVIDUAL%
                    </a>
                    <!--end::Add %OBJETO_VIEW%-->
                </div>
                <!--end::Toolbar-->

                
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        @include('cruds.%OBJETO_VIEW%.filters')

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

    @include('cruds.%OBJETO_VIEW%.filters_script')
    @endpush

</x-default-layout>