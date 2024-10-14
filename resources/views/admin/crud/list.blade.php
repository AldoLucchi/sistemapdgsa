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
                    
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar w-50">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end w-100" data-kt-crud-table-toolbar="base">
                    <div class="row w-100">
                        <div class="col-3">
                            <!--begin::Refresh-->
                            <a href="{{ url('/admin/crudRefreshAll' ) }}" class="btn btn-primary me-1">
                                {!! getIcon('arrows-circle', 'fs-2', '', 'i') !!}
                                Refresh
                            </a>
                            <!--end::Refresh-->
                        </div>
                        <div class="col-3">
                            <!--begin::Add crud-->
                            <button type="button" id="createCrud" name="createCrud" class="btn btn-primary me-1">
                                {!! getIcon('plus', 'fs-2', '', 'i') !!}
                                Agregar
                            </button>
                            <!--end::Add crud-->
                        </div>
                        <div class="col-6  d-none" id="tableSelectDiv" name="tableSelectDiv">
                            <select class="form-select form-select-transparent " name="tableSelect" id="tableSelect">
                                <option value="">-Seleccione una tabla para agregar-</option>
                                @foreach($tables as $table)
                                <option value="{{ $table }}">{{ $table }}</option>
                                @endforeach
                            </select>
                        </div>                       
                    </div>
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
        /*
        document.getElementById('mySearchInput').addEventListener('keyup', function() {
            window.LaravelDataTables['crud-table'].search(this.value).draw();
        });
        */

        document.getElementById('createCrud').addEventListener('click', function() {
            console.log('createCrud');
            document.getElementById('tableSelectDiv').classList.remove('d-none');
           /*
            var tableSelected =  document.getElementById('tableSelect').value;
            if(tableSelected ){
                console.log('tableSelect -- ' + tableSelect);
                window.location.replace("{{ url('/admin/crud/create' ) }}/" + tableSelected);
            }
            */
        });

        
        document.getElementById('tableSelect').addEventListener('change', function() {
            var tableSelected = this.value;
            console.log('tableSelect -- ' + tableSelect);

            window.location.replace("{{ url('/admin/crud/create' ) }}/" + tableSelected);
        });
        
    </script>
    @endpush

</x-default-layout>