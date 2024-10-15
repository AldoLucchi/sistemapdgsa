           
<!--begin::Search-->
<div class="d-flex align-items-center position-relative my-1">    
    <input type="text" data-kt-crud-table-filter="search" class="form-control form-control-solid w-250px ps-3" placeholder="Buscar" id="texto" name="texto" value="{{ (isset($texto))?$texto:'' }}" />
    <span id="texto_search" name="texto_search" style="cursor:pointer;">{!! getIcon('magnifier', 'fs-3  ms-1 ') !!}</span>
</div>
<!--end::Search-->

