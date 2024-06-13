<div class="modal fade" id="kt_modal_add_crud" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered  modal-xl ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_crud_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Agregar CRUD</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_crud_form" class="form" action="{{ route('admin.crud.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="method" value="POST">

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_crud_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_crud_header" data-kt-scroll-wrappers="#kt_modal_add_crud_scroll" data-kt-scroll-offset="300px">
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Tabla</label>
                            <!--end::Label-->
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            <!--begin::Crud-->
                            <select name="nombre" id="nombre" class="form-select form-select-transparent" aria-label="Seleccione una opción" onchange="changeName()">
                                <option value="">Elija una opción</option>
                                @foreach($cruds_filtered as $crud_table)
                                <option id="{{ $crud_table }}" value="{{ $crud_table }}">{{ $crud_table }}</option>
                                @endforeach
                            </select>
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                         <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Alias opción</label>
                            <!--end::Label-->
                            @error('alias_opcion')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            <!--begin::Crud-->
                            <input type="text" class="form-control" name="alias_opcion" id="alias_opcion" placeholder=""/>
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    </div>
                    <!--end::Scroll-->

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_crud_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_crud_header" data-kt-scroll-wrappers="#kt_modal_add_crud_scroll" data-kt-scroll-offset="300px">

                        @foreach($cruds_filtered_columns as $key => $crud_table)
                        <div class=".crud-table d-none table-responsive text-center" id="crud-table-{{ $key }}" >
                            <h3 class="text-center mb-3"><b>Tabla: {{ $key }}</b></h3>
                            <p>Nota: si ningún campo esta marcado para incluir, automáticamente se incluyen todos</p>
                            <table class="table table-bordered table-striped table-hover g-1 text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <td><b>Field</b></td>
                                        <td><b>Type</b></td>
                                        <td><b>Null</b></td>
                                        <td><b>Key</b></td>
                                        <td><b>Default</b></td>
                                        <td><b>Extra</b></td>
                                        <td><b>Incluir campo</b></td>
                                        <td><b>Seleccionar FK</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($crud_table as $column)
                                    <tr>
                                        <td>{{ $column->Field }}</td>
                                        <td>{{ $column->Type }}</td>
                                        <td>{{ $column->Null }}</td>
                                        <td>{{ $column->Key }}</td>
                                        <td>{{ $column->Default }}</td>
                                        <td>{{ $column->Extra }}</td>
                                        <td>
                                            <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field }}" id="{{ $key.'_'.$column->Field }}">
                                        </td>
                                        <td>
                                            <select name="{{ $key.'_'.$column->Field.'_select' }}" id="{{ $key.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción" >
                                                <option></option>
                                                @foreach($cruds_availables as $crud_table)
                                                <option id="{{ $crud_table }}">{{ $crud_table }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endforeach

                    </div>
                    <!--end::Scroll-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Cancelar</button>
                        <button type="submit" class="btn btn-primary" data-kt-crud-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Crear</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<script>
    function changeName() {
        replaceClassInContainer(".crud-table", "d-none");        
        var table_selected = document.getElementById("nombre").value;
        var element = "crud-table-"+table_selected;
        document.getElementById(element ).classList.remove("d-none");
    }

    function replaceClassInContainer(selector, content) {
        var nodeList = document.getElementsByClassName(selector);
        for (var i = 0, length = nodeList.length; i < length; i++) {
            nodeList[i].classList.add("d-none");
        }
    }
</script>