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
                CREAR
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-EtiquetasDocumentos104-table-toolbar="base">
                <!--begin::Add EtiquetasDocumentos104-->
                
                <!--end::Add EtiquetasDocumentos104-->
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
        <form id="add_EtiquetasDocumentos104_form" name="add_EtiquetasDocumentos104_form" class="form" action="{{ route('admin.etiquetaDocumento.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
        @include('cruds.EtiquetasDocumentos104.fields')
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
<script>    
    
</script>
@endpush

</x-default-layout>