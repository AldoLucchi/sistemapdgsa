<x-default-layout>

    @section('title')
    <a href="{{ url('/admin/crud' ) }}">
        CRUD
    </a>
    @endsection



    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-crud-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-crud-table-toolbar="base">
                    <!--begin::Add crud-->
                    <a href="{{ url('/admin/crud/create' ) }}" class="btn btn-primary">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar CRUD
                    </a>
                    <!--end::Add crud-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:crud.add-crud-modal></livewire:crud.add-crud-modal>
                <livewire:crud.edit-crud-modal></livewire:crud.edit-crud-modal>
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
            window.LaravelDataTables['crud-table'].search(this.value).draw();
        });
       
    </script>
    @endpush

</x-default-layout>