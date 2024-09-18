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
                        <label class="tex-secondary">Tamaño máximo del nombre de tabla: 32 caracteres</label>
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
                                    @foreach($crud_table as $column)
                                    <tr id="{{ $key.'_'.$column->Field }}_tr" class="my-5 py-5" data-bs-toggle="collapse" data-bs-target="#{{ $key.'_'.$column->Field }}_tr_collapse" aria-expanded="false" aria-controls="{{ $key.'_'.$column->Field }}_tr_collapse">
                                        <td class="my-5 py-5">#{{ $loop->iteration }} </td>
                                        <td> {{ $column->Field }}</td>
                                        <td>{{ $column->Type }}</td>
                                        <td>{{ $column->Key }}</td>
                                        <td>{{ $column->Null }}</td>
                                        <td>{{ $column->Default }} | {{ $column->Extra }}</td>
                                        <td><i class="ki-duotone ki-down"></i></td>

                                    </tr>
                                    <tr id="{{ $key.'_'.$column->Field }}_tr_collapse" class="collapse">
                                        <td colspan="6">
                                            <table class="my-5 table table-bordered   border  border-primary">
                                                <tr class="bg-primary">
                                                    <td><b>Indice</td>
                                                    <td><b>Incluir <br>campo</b></td>
                                                    <td><b>Incluir <br>list</b></td>
                                                    <td><b>Alias</b></td>
                                                    <td><b>Texto <br> Ayuda</b></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_indice' }}" id="{{ $key.'_'.$column->Field.'_indice' }}" size="2" value="{{ $loop->iteration }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field }}" id="{{ $key.'_'.$column->Field }}" @if($loop->iteration == 1) checked @endif>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_list' }}" id="{{ $key.'_'.$column->Field.'_list' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_alias' }}" id="{{ $key.'_'.$column->Field.'_alias' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_help' }}" id="{{ $key.'_'.$column->Field.'_help' }}">
                                                    </td>
                                                </tr>
                                                <tr class="bg-primary">
                                                    <td><b>Validación <br>Regex</b></td>
                                                    <td><b>Validación <br>maxlength</b></td>
                                                    <td><b>Requerido</b></td>
                                                    <td><b>Readonly</b></td>
                                                    <td><b>Hidden</b></td>

                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_regex' }}" id="{{ $key.'_'.$column->Field.'_regex' }}" style="width:90%;">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_maxlength' }}" id="{{ $key.'_'.$column->Field.'_maxlength' }}" size="2">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_required' }}" id="{{ $key.'_'.$column->Field.'_required' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_readonly' }}" id="{{ $key.'_'.$column->Field.'_readonly' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_hidden' }}" id="{{ $key.'_'.$column->Field.'_hidden' }}">
                                                    </td>
                                                </tr>
                                                
                                               
                                                <tr class="bg-success">
                                                    <td colspan="3"><b>Seleccionar <br>FK</b></td>
                                                    <td colspan="2"><b>Style <br>Color</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <select name="{{ $key.'_'.$column->Field.'_select' }}" id="{{ $key.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_availables as $crud_table_available)
                                                            <option value="{{ $crud_table_available }}">{{ $crud_table_available }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_style_color' }}" id="{{ $key.'_'.$column->Field.'_style_color' }}" style="width:90%;">
                                                    </td>
                                                </tr>

                                                <tr class="bg-danger">
                                                    <td colspan="2"><b>Campo Anidado<br>FK</b></td>
                                                    <td colspan="3"><b>Reglas select <br>FK</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <select name="{{ $key.'_'.$column->Field.'_anidado' }}" id="{{ $key.'_'.$column->Field.'_anidado' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($crud_table as $columnDepend)
                                                            <option value="{{ $columnDepend->Field }}">{{ $columnDepend->Field}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="3">
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_select_rules' }}" id="{{ $key.'_'.$column->Field.'_select_rules' }}" style="width:90%;">
                                                    </td>
                                                </tr>

                                                <tr class="bg-info">
                                                    <td colspan="3"><b>Reglas <br>CRUD anidado</b></td>
                                                    <td colspan="2"><b>Campo dependiente<br>oculto FK</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_crud_anidado_rules' }}" id="{{ $key.'_'.$column->Field.'_crud_anidado_rules' }}" style="width:90%;">
                                                    </td>
                                                    <td colspan="2">
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_dependiente_oculto_rules' }}" id="{{ $key.'_'.$column->Field.'_dependiente_oculto_rules' }}" style="width:90%;">
                                                    </td>
                                                </tr>
                                                <tr class="bg-warning">
                                                    <td colspan="3"><b>Incluir <br>Acorddion en</b></td>
                                                    <td colspan="2"><b>Permisos <br>Acorddion</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <select name="{{ $key.'_'.$column->Field.'_show_fk' }}" id="{{ $key.'_'.$column->Field.'_show_fk' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_generated as $crud)
                                                            <option value="{{ $crud->id }}">{{ $crud->alias_opcion }} | {{ $crud->nombre_componente }} | {{ $crud->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan="2">
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

                        <table class="table border border-primary text-start">
                            <tr class="bg-primary">
                                <td>
                                    Indice: se utiliza para configurar el orden del campo en los listados y formularios de los CRUD
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Incluir campo: si ningún campo esta marcado para incluir, automáticamente se incluyen todos
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Incluir list: si ningún campo esta marcado para incluir, automáticamente se incluyen todos
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Alias: se utiliza para asignar un texto personalizado, en el label de un campo del CRUD
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Texto ayuda: se utiliza para asignar un texto de ayuda, debajo del campo, en los formularios de un CRUD
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Regex (validación): solo para campos de tipo: text, date, search, url, tel, email, and password. Ejemplos:
                                    <br>-validación de todos los caracteres en minúsuculas: ^[a-z][a-z0-9_.]*$
                                    <br>-validación solo letras: ^[a-zA-Z]*$
                                    <br>-validación para emails: ^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$
                                    <br>-validación para teléfono (9 dígitos): ^(\d{7})$

                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Maxlength (validación): se utiliza para limitar la cantidad de caracteres de un campo
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Requerido (validación): se utiliza para configurar un campo como obligatorio
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Readonly: se utiliza para configurar un campo como solo lectura
                                </td>
                            </tr>
                            <tr class="bg-primary">
                                <td>
                                    Hidden: se utiliza para ocultar campos de los form de creación / edición
                                </td>
                            </tr>

                            <tr class="bg-success">
                                <td>
                                    Seleccionar FK: se utiliza para configurar una tabla foranea asociada al campo. Esto permite desplegar un select con los valores de dicha tabla
                                </td>
                            </tr>
                            <tr class="bg-success">
                                <td>
                                    Style Color: se utiliza para estilizar valores de campos select los listados. Colores válidos: primary, secondary, success, info, warning, danger, dark, white, muted, gray-100 a gray-900. Por ejemplo: idestatus,=,1,success;idestatus,=2,danger;
                                </td>
                            </tr>
                            <tr class="bg-danger">
                                <td>
                                    Campos anidados FK: (requiere Seleccionar FK) permite seleccionar una dependencia con otro campo, y esto habilita un filtrado dinámico según el valor seleccionado del campo dependiente
                                </td>
                            </tr>
                            <tr class="bg-danger">
                                <td>
                                    Reglas Select FK: (requiere Seleccionar FK) para setear una o más reglas de filtrado, el formato es el siguiente: campo,operador,valor;campo,operador,valor
                                </td>
                            </tr>

                            <tr class="bg-info">
                                <td>
                                    Reglas CRUD anidado: (requiere Seleccionar FK) para setear una o más reglas de crud anidado, el formato es el siguiente: campo,operador,valor,idcrud,cantidadregistros;campo,operador,valor,idcrud,cantidadregistros
                                </td>
                            </tr>
                            <tr class="bg-info">
                                <td>
                                    Reglas campos dependientes ocultos: (requiere Seleccionar FK) para setear una o más reglas de campos dependientes ocultos, el formato es el siguiente: campo,operador,valor,nombrecampo1:nombrecampos2;campo,operador,valor,nombrecampo1
                                </td>
                            </tr>
                            <tr class="bg-warning">
                                <td>
                                    Incluir accordion: permite asociar un crud dentro de un crud, por un campo en común
                                </td>
                            </tr>
                            <tr class="bg-warning">
                                <td>
                                    Permisos accordion: (requiere Incluir accordion) permite configurar las acciones dentro de un accordion: crear, ver, editar, eliminar
                                </td>
                            </tr>
                        </table>

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