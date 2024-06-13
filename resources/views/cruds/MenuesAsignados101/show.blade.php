<x-default-layout>
@section('title')
MenuesAsignados
@endsection

@section('breadcrumbs')
{{ Breadcrumbs::render('admin.menuAsignado.show', $MenuesAsignados101) }}
@endsection

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                <input type="text" data-kt-MenuesAsignados101-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->

        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-MenuesAsignados101-table-toolbar="base">
                <!--begin::Add MenuesAsignados101-->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_MenuesAsignados101">
                    {!! getIcon('plus', 'fs-2', '', 'i') !!}
                    Agregar MenuesAsignados101
                </button>
                <!--end::Add MenuesAsignados101-->
            </div>
            <!--end::Toolbar-->

            <!--begin::Modal-->
            <livewire:MenuesAsignados101.add-MenuesAsignados101-modal></livewire:MenuesAsignados101.add-MenuesAsignados101-modal>
            <!--end::Modal-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div class="row">
        @include('cruds.MenuesAsignados101.fields')
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