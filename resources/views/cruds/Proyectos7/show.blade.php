<x-default-layout>
@section('title')
Proyectos
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('Proyectos7.show', $Proyectos7) }}
@endsection

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                <input type="text" data-kt-Proyectos7-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-Proyectos7-table-toolbar="base">
                <!--begin::Add Proyectos7-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Proyectos7">
                    {!! getIcon('plus', 'fs-2', '', 'i') !!}
                    Agregar Proyectos7
                </button>
                <!--end::Add Proyectos7-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Modal-->
            <livewire:Proyectos7.add-Proyectos7-modal></livewire:Proyectos7.add-Proyectos7-modal>
            <!--end::Modal-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div class="row">
        @include('cruds.Proyectos7.fields')
        </div>
        <!--end::Table-->
    </div>
    <!--end::Card body-->
</div>

@push('scripts')

<script>
    
    document.addEventListener('livewire:init', function() {
        Livewire.on('success', function() {
            $('#kt_modal_add_usuarios').modal('hide');
            window.LaravelDataTables['usuarios-table'].ajax.reload();
        });
    });
    $('#kt_modal_add_usuarios').on('hidden.bs.modal', function() {
        Livewire.dispatch('new_usuarios');
    });
</script>
@endpush

</x-default-layout>