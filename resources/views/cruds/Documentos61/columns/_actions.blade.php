<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Acción
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    @if( (request()->segment(2) == 'documento') || (request()->segment(2) != 'documento' && Session::has('Documentos61_read') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url('/'. (Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento').'/'. $Documentos61->iddocumento ) }}" class="menu-link px-3">
            Ver
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'documento') || (request()->segment(2) != 'documento' && Session::has('Documentos61_update') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <!--<a href="#" class="menu-link px-3" data-kt-Documentos61-id="{{ $Documentos61->iddocumento }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Documentos61" data-kt-action="update_row">-->
        <a href="{{ url('/'.(Session::has('Documentos61')?Session::get('Documentos61'):'admin/documento').'/'. $Documentos61->iddocumento .'/edit' ) }}" class="menu-link px-3">
            Editar
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'documento') || (request()->segment(2) != 'documento' && Session::has('Documentos61_delete') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <form id="destroy_Documentos61_form_{{ $Documentos61->iddocumento }}" name="destroy_Documentos61_form_{{ $Documentos61->iddocumento }}" class="form destroy_Documentos61_form" action="{{ route('admin.documento.destroy', $Documentos61) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-link btn-xs menu-link fs-7  ms-3 px-3" data-kt-Documentos61-id="{{ $Documentos61->iddocumento }}" data-kt-action="delete_row" value="{{ $Documentos61->iddocumento }}">
                Eliminar
            </button>
        </form>
    </div>
    <!--end::Menu item-->
    @endif

 
</div>
<!--end::Menu-->

