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
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                CREAR
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-%OBJETO_ROUTE%-table-toolbar="base">
                <!--begin::Add %OBJETO_ROUTE%-->
                
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
        <form id="add_%OBJETO_ROUTE%_form" name="add_%OBJETO_ROUTE%_form" class="form" action="{{ route('crud.%OBJETO_ROUTE%.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        @include('cruds.%OBJETO_VIEW%.fields')
        </div>
        <div class="row">
            <div class="d-flex justify-content-end" >                
                <button type="submit" class="btn btn-primary" >
                    Crear
                </button>               
            </div>
        </div>

        </form>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>

@push('scripts')
@include('cruds.%OBJETO_VIEW%.scripts')
@endpush

</x-default-layout>