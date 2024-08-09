<!--begin::Input group-->
<div class="mb-7 col-12 col-lg-4">
    <!--begin::Label-->
    <label class="required fw-semibold fs-6 mb-5">Alias opción</label>
    <!--end::Label-->
    @error('alias_opcion')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <!--begin::Crud-->
    <input type="text" class="form-control" name="alias_opcion" id="alias_opcion" placeholder="" value="{{ (isset($crud)?$crud->alias_opcion:'') }}" />
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
    <input type="text" class="form-control" name="alias_opcion_individual" id="alias_opcion_individual" placeholder="" value="{{ (isset($crud)?$crud->alias_opcion_individual:'') }}" />
    <!--end::Crud-->
</div>
<!--end::Input group-->

<!--begin::Input group-->
<div class="mb-7 col-12 col-lg-4">
    <!--begin::Label-->
    <label class="required fw-semibold fs-6 mb-5">Rules</label>
    <!--end::Label-->
    @error('reglas')
    <span class="text-danger">{{ $message }}</span>
    @enderror
    <!--begin::Crud-->
    <input type="text" class="form-control" name="reglas" id="reglas" placeholder="" value="{{ (isset($crud)?$crud->reglas:'') }}" />
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
        <option value="{{ $option }}" {{ (isset($crud) && in_array($option, explode(',', $crud->crud_permisos)  ))?'selected':'' }}>{{ $option }}</option>
        @endforeach
    </select>
    <!--end::Crud-->
</div>
<!--end::Input group-->