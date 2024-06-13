<x-default-layout>

    @section('title')
    Menues
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('admin.menu.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-Menues97-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-Menues97-table-toolbar="base">
                    <!--begin::Add Menues97-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Menues97">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar Menues
                    </button>
                    <!--end::Add Menues97-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:Menues97.add-Menues97-modal></livewire:Menues97.add-Menues97-modal>
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
            window.LaravelDataTables['Menues97-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_Menues97').modal('hide');
                window.LaravelDataTables['Menues97-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_Menues97').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_Menues97');
        });
    </script>
    @endpush

</x-default-layout>