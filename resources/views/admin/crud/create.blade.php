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

                    @include('admin.crud.fields')
                </div>

                <div class="row">
                    @foreach($cruds_filtered_columns as $key => $crud_table)
                    <div class=".crud-table d-none table-responsive text-center" id="crud-table-{{ $key }}">
                        <h3 class="text-center mb-3"><b>Tabla: {{ $key }}</b></h3>


                        <fieldset id="crud-fieldset-{{ $key }}" disabled>
                            <table class="table table-bordered table-striped table-hover g-1 text-center ">
                                <thead class="text-uppercase">
                                    <tr>
                                        <td><b>Field</b></td>
                                        <td><b>Type</b></td>
                                        <td><b>Key</b></td>
                                        <td><b>Null</b></td>
                                        <td><b>Default</b></td>
                                        <td><b>Extra</b></td>
                                        <td><b></b></td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($crud_table as $column)
                                    <tr id="{{ $key.'_'.$column->Field }}_tr" class="my-5 py-5" data-bs-toggle="collapse" data-bs-target="#{{ $key.'_'.$column->Field }}_tr_collapse" aria-expanded="false" aria-controls="{{ $key.'_'.$column->Field }}_tr_collapse">
                                        <td class="my-5 py-5">{{ $column->Field }}</td>
                                        <td>{{ $column->Type }}</td>
                                        <td>{{ $column->Key }}</td>
                                        <td>{{ $column->Null }}</td>
                                        <td>{{ $column->Default }}</td>
                                        <td>{{ $column->Extra }}</td>
                                        <td><i class="ki-duotone ki-down"></i></td>

                                    </tr>
                                    <tr id="{{ $key.'_'.$column->Field }}_tr_collapse" class="collapse">
                                        <td colspan="6">
                                            <table class="my-5 table table-bordered   border border-secondary bg-primary">
                                                <tr>
                                                    <td><b>Indice</td>
                                                    <td><b>Incluir <br>campo</b></td>
                                                    <td><b>Incluir <br>list</b></td>
                                                    <td><b>Alias</b></td>
                                                    <td><b>Validación <br>Regex</b></td>
                                                    <td><b>Validación <br>maxlength</b></td>
                                                    <td><b>Requerido</b></td>
                                                    <td><b>Readonly</b></td>                                                    
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_indice' }}" id="{{ $key.'_'.$column->Field.'_indice' }}" size="2" value="{{ $loop->iteration }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field }}" id="{{ $key.'_'.$column->Field }}" checked>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_list' }}" id="{{ $key.'_'.$column->Field.'_list' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_alias' }}" id="{{ $key.'_'.$column->Field.'_alias' }}" >
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_regex' }}" id="{{ $key.'_'.$column->Field.'_regex' }}" >
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_maxlength' }}" id="{{ $key.'_'.$column->Field.'_maxlength' }}" size="2" >
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_required' }}" id="{{ $key.'_'.$column->Field.'_required' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_readonly' }}" id="{{ $key.'_'.$column->Field.'_readonly' }}">
                                                    </td>                                                    
                                                </tr>
                                                <tr>

                                                    <td colspan=2><b>Seleccionar <br>FK</b></td>
                                                    <td><b>Reglas <br>FK</b></td>
                                                    <td colspan=2><b>Incluir <br>Acorddion en:</b></td>
                                                    <td colspan=2><b>Permisos <br>Acorddion</b></td>

                                                </tr>
                                                <tr>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_select' }}" id="{{ $key.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_availables as $crud_table)
                                                            <option value="{{ $crud_table }}">{{ $crud_table }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_select_rules' }}" id="{{ $key.'_'.$column->Field.'_select_rules' }}" size="10">
                                                    </td>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_show_fk' }}" id="{{ $key.'_'.$column->Field.'_show_fk' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_generated as $crud)
                                                            <option value="{{ $crud->id }}">{{ $crud->alias_opcion }} | {{ $crud->nombre_componente }} | {{ $crud->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}[]" id="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}" class="form-select form-select-transparent py-5 select2" aria-label="Seleccione una opción" data-control="select2" multiple="multiple">
                                                            <option value="">---</option>
                                                            @foreach($options_crud as $option)
                                                            <option value="{{ $option }}">{{ $option }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </fieldset>

                        <p>Nota: si ningún campo esta marcado para incluir, automáticamente se incluyen todos</p>
                        <p>Rules: para setear una o más reglas, el formato es el siguiente: campo,operador,valor;campo,operador,valor</p>
                        <p>Regex: solo para campos de tipo: text, date, search, url, tel, email, and password. Ejemplos: 
                            <br>-validación de todos los caracteres en minúsuculas: ^[a-z][a-z0-9_.]*$
                            <br>-validación solo letras: ^[a-zA-Z]*$
                            <br>-validación para emails: ^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$
                            <br>-validación para teléfono (9 dígitos): ^(\d{7})$
                        </p>
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