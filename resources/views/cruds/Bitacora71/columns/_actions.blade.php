<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Acción
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    @if( (request()->segment(2) == 'bitacora') || (request()->segment(2) != 'Bitacora71' && Session::has('Bitacora71_read') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url('/admin/bitacora').'/'. $Bitacora71->idbitacora  }}" class="menu-link px-3">
            Ver
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'bitacora') || (request()->segment(2) != 'Bitacora71' && Session::has('Bitacora71_update') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <!--<a href="#" class="menu-link px-3" data-kt-Bitacora71-id="{{ $Bitacora71->idbitacora }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Bitacora71" data-kt-action="update_row">-->
        <a href="{{ url('/admin/bitacora').'/'. $Bitacora71->idbitacora .'/edit'  }}" class="menu-link px-3">
            Editar
        </a>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'bitacora') || (request()->segment(2) != 'Bitacora71' && Session::has('Bitacora71_delete') ) )
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <form id="destroy_Bitacora71_form_{{ $Bitacora71->idbitacora }}" name="destroy_Bitacora71_form_{{ $Bitacora71->idbitacora }}" class="form destroy_Bitacora71_form" action="{{ route('admin.bitacora.destroy', $Bitacora71) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-link btn-xs menu-link fs-7  ms-3 px-3" data-kt-Bitacora71-id="{{ $Bitacora71->idbitacora }}" data-kt-action="delete_row" value="{{ $Bitacora71->idbitacora }}">
                Eliminar
            </button>
        </form>
    </div>
    <!--end::Menu item-->
    @endif

    @if( (request()->segment(2) == 'bitacora') || (request()->segment(2) != 'Bitacora71' && Session::has('Bitacora71_read') ) )    
    @foreach($documentos as $key => $documento)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url($documento. $Bitacora71->idbitacora ) }}" class="menu-link px-3" target="_blank">
            Pdf: {{ $key }}
        </a>
    </div>
    <!--end::Menu item-->
    @endforeach
    @endif    
</div>
<!--end::Menu-->

