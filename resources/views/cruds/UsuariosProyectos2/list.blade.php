<x-default-layout>

    @section('title')
    UsuariosProyectos
    @endsection

    @section('breadcrumbs')
    {{ Breadcrumbs::render('UsuariosProyectos2.index') }}
    @endsection

    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
                    <input type="text" data-kt-UsuariosProyectos2-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="mySearchInput" />
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-UsuariosProyectos2-table-toolbar="base">
                    <!--begin::Add UsuariosProyectos2-->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_UsuariosProyectos2">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Agregar UsuariosProyectos
                    </button>
                    <!--end::Add UsuariosProyectos2-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <livewire:UsuariosProyectos2.add-UsuariosProyectos2-modal></livewire:UsuariosProyectos2.add-UsuariosProyectos2-modal>
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
            window.LaravelDataTables['UsuariosProyectos2-table'].search(this.value).draw();
        });
        document.addEventListener('livewire:init', function() {
            Livewire.on('success', function() {
                $('#kt_modal_add_UsuariosProyectos2').modal('hide');
                window.LaravelDataTables['UsuariosProyectos2-table'].ajax.reload();
            });
        });
        $('#kt_modal_add_UsuariosProyectos2').on('hidden.bs.modal', function() {
            Livewire.dispatch('new_UsuariosProyectos2');
        });
    </script>
    @endpush

</x-default-layout>