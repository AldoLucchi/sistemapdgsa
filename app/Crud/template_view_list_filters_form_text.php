           
<!--begin::Search-->
<div class="d-flex align-items-center position-relative my-1">
    {!! getIcon('magnifier', 'fs-3 position-absolute ms-5') !!}
    <input type="text" data-kt-crud-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Buscar" id="texto" name="texto" value="{{ (isset($texto))?$texto:'' }}" />
</div>
<!--end::Search-->

