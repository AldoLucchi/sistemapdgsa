<x-default-layout>

    @section('title')
    MenuesAsignados
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('admin.menuAsignado.index') }}
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
                        Agregar MenuesAsignados
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
            window.LaravelDataTables['MenuesAsignados101-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_MenuesAsignados101').modal('hide');
                window.LaravelDataTables['MenuesAsignados101-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_MenuesAsignados101').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_MenuesAsignados101');
        });
    </script>
    @endpush

</x-default-layout>