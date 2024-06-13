<x-default-layout>

    @section('title')
    Users
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('Users8.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-Users8-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-Users8-table-toolbar="base">
                    <!--begin::Add Users8-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Users8">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Users
                    </button>
                    <!--end::Add Users8-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:Users8.add-Users8-modal></livewire:Users8.add-Users8-modal>
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
            window.LaravelDataTables['Users8-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_Users8').modal('hide');
                window.LaravelDataTables['Users8-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_Users8').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_Users8');
        });
    </script>
    @endpush

</x-default-layout>