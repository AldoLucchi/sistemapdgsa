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
                    EDITAR
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

            <form id="edit_CRUD_form" name="edit_CRUD_form" class="form" action="{{ route('admin.crud.update', $crud) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <input type="hidden" name="crud_id" id="crud_id" value="{{ (isset($crud)?$crud->id:'') }}">

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
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{ (isset($crud)?$crud->nombre:'--') }}" readonly>
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-7 col-12 col-lg-6">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Nombre componente</label>
                        <!--end::Label-->
                        @error('nombre_componente')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <input type="text" class="form-control" name="nombre_componente" id="nombre_componente" value="{{ (isset($crud)?$crud->nombre_componente:'--') }}" readonly>
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->

                    @include('admin.crud.fields')

                    <!--begin::Input group-->
                    <div class="mb-7  col-12 col-lg-4">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Estatus</label>
                        <!--end::Label-->
                        @error('estatus')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!--begin::Crud-->
                        <input type="checkbox" class="" name="estatus" id="estatus" value="{{ (isset($crud)?$crud->estatus:'')  }}" {{ (isset($crud) && $crud->estatus ?'checked':'') }} placeholder="" />
                        <!--end::Crud-->
                    </div>
                    <!--end::Input group-->
                </div>

                <div class="row">
                    @foreach($cruds_filtered_columns as $key => $crud_table)
                    @if(isset($crud) && $key == $crud->nombre)
                    <div class=".crud-table  table-responsive text-center" id="crud-table-{{ $key }}">
                        <h3 class="text-center mb-3"><b>Tabla: {{ $key }}</b></h3>

                        <fieldset id="crud-fieldset-{{ $key }}">
                            <table class="table table-bordered table-striped table-hover g-1 text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <td><b>Field</b></td>
                                        <td><b>Type</b> </td>
                                        <td><b>Key</b></td>
                                        <td><b>Null</b></td>
                                        <td><b>Default</b></td>
                                        <td><b>Extra</b></td>
                                        <td><b></b></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($crud_table as $column)
                                    @php
                                    $campoPreference = null;
                                    @endphp

                                    @foreach($crud_campos as $campo)
                                    @php
                                    if($column->Field == $campo->field){
                                    $campoPreference = $campo;
                                    }
                                    @endphp
                                    @endforeach
                                    <tr id="{{ $key.'_'.$column->Field }}_tr" class="my-5 py-5" data-bs-toggle="collapse" data-bs-target="#{{ $key.'_'.$column->Field }}_tr_collapse" aria-expanded="false" aria-controls="{{ $key.'_'.$column->Field }}_tr_collapse">
                                        <td class="my-5 py-5">{{ $column->Field }}</td>
                                        <td>
                                            {{ $column->Type }}
                                        </td>
                                        <td>
                                            {{ $column->Key }}
                                        </td>
                                        <td>{{ $column->Null }}</td>
                                        <td>
                                            {{ $column->Default }}
                                        </td>
                                        <td>
                                            {{ $column->Extra }}
                                        </td>
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
                                                    <td><b>Validación <br> Regex</b></td>
                                                    <td><b>Validación <br> maxlength</b></td>
                                                    <td><b>Requerido</b></td>
                                                    <td><b>Readonly</b></td>                                                   
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_indice' }}" id="{{ $key.'_'.$column->Field.'_indice' }}" size="2" value="{{ ($campoPreference && isset($campoPreference->indice))?$campoPreference->indice:'' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field }}" id="{{ $key.'_'.$column->Field }}" {{ ($campoPreference && $campoPreference->incluir_campo)?'checked':'' }}>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_list' }}" id="{{ $key.'_'.$column->Field.'_list' }}" {{ ($campoPreference && $campoPreference->incluir_list)?'checked':'' }}>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_alias' }}" id="{{ $key.'_'.$column->Field.'_alias' }}"  value="{{ ($campoPreference)?$campoPreference->alias:'' }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_regex' }}" id="{{ $key.'_'.$column->Field.'_regex' }}"  value="{{ ($campoPreference && isset($campoPreference->regex) && $campoPreference->regex)?$campoPreference->regex:'' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" class="form-input" name="{{ $key.'_'.$column->Field.'_maxlength' }}" id="{{ $key.'_'.$column->Field.'_maxlength' }}" size="2" value="{{ ($campoPreference && isset($campoPreference->maxlength))?$campoPreference->maxlength:'' }}">
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_required' }}" id="{{ $key.'_'.$column->Field.'_required' }}" {{ ($campoPreference && isset($campoPreference->required) && $campoPreference->required)?'checked':'' }}>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" class="form-check-input" name="{{ $key.'_'.$column->Field.'_readonly' }}" id="{{ $key.'_'.$column->Field.'_readonly' }}" {{ ($campoPreference && isset($campoPreference->incluir_readonly) && $campoPreference->incluir_readonly)?'checked':'' }}>
                                                    </td>                                                    
                                                </tr>
                                                <tr>
                                                    <td colspan=2><b>Seleccionar FK</b></td>
                                                    <td><b>Reglas FK</b></td>
                                                    <td colspan=2><b>Incluir <br>Acorddion en:</b></td>
                                                    <td colspan=2><b>Permisos <br>Acorddion</b></td>
                                                </tr>
                                                <tr>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_select' }}" id="{{ $key.'_'.$column->Field.'_select' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_availables as $crud_table)
                                                            <option value="{{ $crud_table }}" {{ ($campoPreference && $campoPreference->select == $crud_table)?'selected':'' }}>{{ $crud_table }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-input" name="{{ $key.'_'.$column->Field.'_select_rules' }}" id="{{ $key.'_'.$column->Field.'_select_rules' }}" size="10" value="{{ ($campoPreference && isset($campoPreference->select_rules))?$campoPreference->select_rules:'' }}">
                                                    </td>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_show_fk' }}" id="{{ $key.'_'.$column->Field.'_show_fk' }}" class="form-select form-select-transparent" aria-label="Seleccione una opción">
                                                            <option value="">---</option>
                                                            @foreach($cruds_generated as $crud_gen)
                                                            <option value="{{ $crud_gen->id }}" {{ ($campoPreference && $campoPreference->show_fk == $crud_gen->id )?'selected':'' }}>{{ $crud_gen->alias_opcion }} | {{ $crud_gen->nombre_componente }} | {{ $crud_gen->nombre }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td colspan=2>
                                                        <select name="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}[]" id="{{ $key.'_'.$column->Field.'_show_fk_permisos' }}" class="form-select form-select-transparent py-5 select2" aria-label="Seleccione una opción" data-control="select2" multiple="multiple">
                                                            <option value="">---</option>
                                                            @foreach($options_crud as $option)
                                                            <option value="{{ $option }}" {{ ($campoPreference && in_array($option, explode(',', $campoPreference->show_fk_permisos)  ))?'selected':'' }}>{{ $option }}</option>
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
                        <p>Regex: solo para campos de tipo: text, date, search, url, tel, email, and password. Ejemplo /^[a-z]+$/g</p>
                    </div>
                    @endif
                    @endforeach
                </div>

                <div class="row">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Guardar
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
    </script>
    @endpush

</x-default-layout>