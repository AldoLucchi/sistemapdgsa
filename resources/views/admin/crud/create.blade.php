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
                    <div class="mb-7 col-12 ">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Tabla / Nombre</label>
                        <!--end::Label-->
                        @error('nombre')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <input name="nombre" id="nombre" class="form-control" aria-label="Seleccione una opción" onchange="" value="{{ $table_selected }}" readonly>

                        <label class="tex-secondary">Tamaño máximo del nombre de tabla: 32 caracteres</label>
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                    @include('admin.crud.fields')
                </div>

                <div class="row">
                    <div class=".crud-table  table-responsive text-center" id="crud-table-{{ $table_selected }}">
                        <h3 class="text-center mb-3"><b>Tabla: {{ $table_selected }}</b></h3>

                        <fieldset id="crud-fieldset-{{ $table_selected }}">
                            <table class="table table-bordered table-striped table-hover g-1 text-center ">
                                <thead class="text-uppercase">
                                    <tr>
                                        <td><b>#</b></td>
                                        <td><b>Field</b></td>
                                        <td><b>Type</b></td>
                                        <td><b>Key</b></td>
                                        <td><b>Null</b></td>
                                        <td><b>Default</b> | <b>Extra</b></td>
                                        <td><b><i class="ki-duotone ki-down"></i></b></td>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($table_selected_columns as $column)
                                    <tr id="{{ $table_selected.'_'.$column->Field }}_tr" class="my-5 py-5" data-bs-toggle="collapse" data-bs-target="#{{ $table_selected.'_'.$column->Field }}_tr_collapse" aria-expanded="false" aria-controls="{{ $table_selected.'_'.$column->Field }}_tr_collapse">
                                        <td class="my-5 py-5">#{{ $loop->iteration }} </td>
                                        <td> {{ $column->Field }}</td>
                                        <td>{{ $column->Type }}</td>
                                        <td>{{ $column->Key }}</td>
                                        <td>{{ $column->Null }}</td>
                                        <td>{{ $column->Default }} | {{ $column->Extra }}</td>
                                        <td><i class="ki-duotone ki-down"></i></td>

                                    </tr>
                                    <tr id="{{ $table_selected.'_'.$column->Field }}_tr_collapse" class="collapse">
                                        <td colspan="6">
                                            <table class="my-5 table table-bordered   border  border-primary">
                                                <tr class="bg-primary">
                                                    <td><b>Indice</td>
                                                    <td><b>Incluir campo</b></td>
                                                    <td><b>Incluir list</b></td>
                                                    <td><b>Alias</b></td>
                                                    <td><b>Texto Ayuda</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_indice' }}" id="{{ $table_selected.'_'.$column->Field.'_indice' }}" size="2" value="{{ $loop->iteration }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $table_selected.'_'.$column->Field }}" id="{{ $table_selected.'_'.$column->Field }}" @if($loop->iteration == 1) checked @endif>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $table_selected.'_'.$column->Field.'_list' }}" id="{{ $table_selected.'_'.$column->Field.'_list' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_alias' }}" id="{{ $table_selected.'_'.$column->Field.'_alias' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_help' }}" id="{{ $table_selected.'_'.$column->Field.'_help' }}">
                                                    </td>
                                                </tr>
                                                <tr class="bg-primary">
                                                    <td><b>Validació Regex</b></td>
                                                    <td><b>Validación maxlength</b></td>
                                                    <td><b>Requerido</b></td>
                                                    <td><b>Readonly</b></td>
                                                    <td><b>Hidden</b></td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_regex' }}" id="{{ $table_selected.'_'.$column->Field.'_regex' }}" style="width:90%;">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_maxlength' }}" id="{{ $table_selected.'_'.$column->Field.'_maxlength' }}" size="2">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $table_selected.'_'.$column->Field.'_required' }}" id="{{ $table_selected.'_'.$column->Field.'_required' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $table_selected.'_'.$column->Field.'_readonly' }}" id="{{ $table_selected.'_'.$column->Field.'_readonly' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $table_selected.'_'.$column->Field.'_hidden' }}" id="{{ $table_selected.'_'.$column->Field.'_hidden' }}">
                                                    </td>
                                                </tr>


                                                <tr class="bg-success">
                                                    <td colspan="3"><b>Seleccionar FK</b></td>
                                                    <td colspan="2"><b>Style Color</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <select name="{{ $table_selected.'_'.$column->Field.'_select' }}" id="{{ $table_selected.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_availables as $crud_table_available)
                                                            <option value="{{ $crud_table_available }}">{{ $crud_table_available }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_style_color' }}" id="{{ $table_selected.'_'.$column->Field.'_style_color' }}" style="width:90%;">
                                                    </td>
                                                </tr>

                                                <tr class="bg-danger">
                                                    <td colspan="1"><b>Campo Anidado FK</b></td>
                                                    <td colspan="2"><b>Reglas SQL select FK</b></td>
                                                    <td colspan="2"><b>Reglas select FK</b></td>

                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <select name="{{ $table_selected.'_'.$column->Field.'_anidado' }}" id="{{ $table_selected.'_'.$column->Field.'_anidado' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($table_selected_columns as $columnDepend)
                                                            <option value="{{ $columnDepend->Field }}">{{ $columnDepend->Field}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_select_rules_sql' }}" id="{{ $table_selected.'_'.$column->Field.'_select_rules_sql' }}" style="width:90%;">
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_select_rules' }}" id="{{ $table_selected.'_'.$column->Field.'_select_rules' }}" style="width:90%;">
                                                    </td>


                                                </tr>

                                                <tr class="bg-info">
                                                    <td colspan="3"><b>Reglas CRUD anidado</b></td>
                                                    <td colspan="2"><b>Campo dependiente oculto FK</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_crud_anidado_rules' }}" id="{{ $table_selected.'_'.$column->Field.'_crud_anidado_rules' }}" style="width:90%;">
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_dependiente_oculto_rules' }}" id="{{ $table_selected.'_'.$column->Field.'_dependiente_oculto_rules' }}" style="width:90%;">
                                                    </td>
                                                </tr>
                                                <tr class="bg-warning">
                                                    <td colspan="2"><b>Incluir Acorddion en</b></td>
                                                    <td colspan="1"><b>Índice Acorddion </b></td>
                                                    <td colspan="2"><b>Permisos Acorddion</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <select name="{{ $table_selected.'_'.$column->Field.'_show_fk' }}" id="{{ $table_selected.'_'.$column->Field.'_show_fk' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_generated as $crud)
                                                            <option value="{{ $crud->id }}">{{ $crud->alias_opcion }} | {{ $crud->nombre_componente }} | {{ $crud->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $table_selected.'_'.$column->Field.'_show_indice_fk' }}" id="{{ $table_selected.'_'.$column->Field.'_show_indice_fk' }}" size="2" value="1">
                                                    </td>
                                                    <td colspan="2">
                                                        <select name="{{ $table_selected.'_'.$column->Field.'_show_fk_permisos' }}[]" id="{{ $table_selected.'_'.$column->Field.'_show_fk_permisos' }}" class="form-select form-select-transparent py-5 select2" aria-label="Seleccione una opción" data-control="select2" multiple="multiple">
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

                        @include('admin.crud.description')

                    </div>

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