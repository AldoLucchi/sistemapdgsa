<x-default-layout>

    @section('title')
    %OBJETO_LABEL%
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('%OBJETO_ROUTE%.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-%OBJETO_VIEW%-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-%OBJETO_VIEW%-table-toolbar="base">
                    <!--begin::Add %OBJETO_VIEW%-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_%OBJETO_VIEW%">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar %OBJETO_LABEL%
                    </button>
                    <!--end::Add %OBJETO_VIEW%-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:%OBJETO_VIEW%.add-%OBJETO_VIEW%-modal></livewire:%OBJETO_VIEW%.add-%OBJETO_VIEW%-modal>
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
            window.LaravelDataTables['%OBJETO_VIEW%-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_%OBJETO_VIEW%').modal('hide');
                window.LaravelDataTables['%OBJETO_VIEW%-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_%OBJETO_VIEW%').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_%OBJETO_VIEW%');
        });
    </script>
    @endpush

</x-default-layout>