<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Acción
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    @if( (request()->segment(2) == 'etiquetaDocumento') || (request()->segment(2) != 'etiquetaDocumento' && Session::has('EtiquetasDocumentos104_read') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url('/admin/etiquetaDocumento/'. $EtiquetasDocumentos104->idetiquetadocumento ) }}" class="menu-link px-3">
            Ver
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'etiquetaDocumento') || (request()->segment(2) != 'etiquetaDocumento' && Session::has('EtiquetasDocumentos104_update') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <!--<a href="#" class="menu-link px-3" data-kt-EtiquetasDocumentos104-id="{{ $EtiquetasDocumentos104->idetiquetadocumento }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_EtiquetasDocumentos104" data-kt-action="update_row">-->
        <a href="{{ url('/admin/etiquetaDocumento/'. $EtiquetasDocumentos104->idetiquetadocumento .'/edit' ) }}" class="menu-link px-3">
            Editar
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'etiquetaDocumento') || (request()->segment(2) != 'etiquetaDocumento' && Session::has('EtiquetasDocumentos104_delete') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-EtiquetasDocumentos104-id="{{ $EtiquetasDocumentos104->idetiquetadocumento }}" data-kt-action="delete_row">
            Eliminar
        </a>
    </div>
    <!--end::Menu item-->
    @endif
</div>
<!--end::Menu-->

