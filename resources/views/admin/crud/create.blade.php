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
                    CREAR
                </div>
                <!--end::Search-->
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <!--begin::Toolbar-->
                <div class="d-flex justify-content-end" data-kt-CRUD-table-toolbar="base">
                    <!--begin::Add CRUD-->

                    <!--end::Add CRUD-->
                </div>
                <!--end::Toolbar-->

                <!--begin::Modal-->
                <!--end::Modal-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <!--begin::Table-->
            <form id="add_CRUD_form" name="add_CRUD_form" class="form" action="{{ route('admin.crud.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!--begin::Input group-->
                    <div class="mb-7 col-12 col-lg-4">
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
                    <div class="mb-7 col-12 col-lg-4">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Alias opción</label>
                        <!--end::Label-->
                        @error('alias_opcion')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <input type="text" class="form-control" name="alias_opcion" id="alias_opcion" placeholder="" />
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-7 col-12 col-lg-4">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Alias individual</label>
                        <!--end::Label-->
                        @error('alias_opcion_individual')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <input type="text" class="form-control" name="alias_opcion_individual" id="alias_opcion_individual" placeholder="" />
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-7 col-12 col-lg-4">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">CRUD permisos</label>
                        <!--end::Label-->
                        @error('crud_permisos')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <select name="crud_permisos[]" id="crud_permisos" class="form-select form-select-transparent py-5 select2" aria-label="Seleccione una opción" data-control="select2" multiple="multiple">
                            <option value="">---</option>
                            @foreach($options_crud as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                            @endforeach
                        </select>
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                </div>



                <div class="row">

                    @foreach($cruds_filtered_columns as $key => $crud_table)
                    <div class=".crud-table d-none table-responsive text-center" id="crud-table-{{ $key }}">
                        <h3 class="text-center mb-3"><b>Tabla: {{ $key }}</b></h3>
                        <p>Nota: si ningún campo esta marcado para incluir, automáticamente se incluyen todos</p>
                        <fieldset id="crud-fieldset-{{ $key }}" disabled>
                            <table class="table table-bordered table-striped table-hover g-1 text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <td><b>Field</b></td>
                                        <td><b>Type/</b><br><b>Key</b></td>
                                        <td><b>Null</b></td>
                                        <td><b>Default/</b><br><b>Extra</b></td>
                                        <td><b>Incluir <br>campo</b></td>
                                        <td><b>Incluir <br>list</b></td>
                                        <td><b>Alias</b></td>
                                        <td><b>Seleccionar FK</b></td>
                                        <td><b>Reglas FK</b></td>
                                        <td><b>Incluir <br>Acorddion en:</b></td>
                                        <td><b>Permisos <br>Acorddion</b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($crud_table as $column)
                                    <tr>
                                        <td>{{ $column->Field }}</td>
                                        <td>{{ $column->Type }}<br>{{ $column->Key }}</td>
                                        <td>{{ $column->Null }}</td>
                                        <td>{{ $column->Default }}<br>{{ $column->Extra }}</td>
                                        <td>
                                            <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field }}" id="{{ $key.'_'.$column->Field }}" checked>
                                        </td>
                                        <td>
                                            <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_list' }}" id="{{ $key.'_'.$column->Field.'_list' }}">
                                        </td>
                                        <td>
                                            <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_alias' }}" id="{{ $key.'_'.$column->Field.'_alias' }}">
                                        </td>
                                        <td>
                                            <select name="{{ $key.'_'.$column->Field.'_select' }}" id="{{ $key.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                <option value="">---</option>
                                                @foreach($cruds_availables as $crud_table)
                                                <option value="{{ $crud_table }}">{{ $crud_table }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_select_rules' }}" id="{{ $key.'_'.$column->Field.'_select_rules' }}">
                                        </td>
                                        <td>
                                            <select name="{{ $key.'_'.$column->Field.'_show_fk' }}" id="{{ $key.'_'.$column->Field.'_show_fk' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                <option value="">---</option>
                                                @foreach($cruds_generated as $crud)
                                                <option value="{{ $crud->id }}">{{ $crud->alias_opcion }} | {{ $crud->nombre_componente }} | {{ $crud->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select name="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}[]" id="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}" class="form-select form-select-transparent py-5 select2" aria-label="Seleccione una opción" data-control="select2" multiple="multiple">
                                                <option value="">---</option>
                                                @foreach($options_crud as $option)
                                                <option value="{{ $option }}">{{ $option }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </fieldset>
                    </div>
                    @endforeach
                </div>









                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                </div>

            </form>
            <!--end::Table-->
        </div>
        <!--end::Card body-->
    </div>

    @push('scripts')
    <script>
        function changeName() {
            replaceClassInContainer(".crud-table", "d-none");
            var table_selected = document.getElementById("nombre").value;
            var element = "crud-table-" + table_selected;
            var element_fieldset = "crud-fieldset-" + table_selected;
            document.getElementById(element).classList.remove("d-none");
            document.getElementById(element_fieldset).disabled = false;
        }

        function replaceClassInContainer(selector, content) {
            var nodeList = document.getElementsByClassName(selector);
            for (var i = 0, length = nodeList.length; i < length; i++) {
                nodeList[i].classList.add("d-none");
            }
        }
    </script>
    @endpush

</x-default-layout>