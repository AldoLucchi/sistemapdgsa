<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Acción
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3 %OBJETO_READ%">
        @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_read') ) )
        <a href="{{ url('/'. (Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%').'/'. $%OBJETO_VARIABLE%->%FIELD_ID% ) }}" class="menu-link px-3">
            Ver
        </a>
        @endif
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 %OBJETO_UPDATE%">
        @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_update') ) )
        <!--<a href="#" class="menu-link px-3" data-kt-%OBJETO_ROUTE%-id="{{ $%OBJETO_VARIABLE%->%FIELD_ID% }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_%OBJETO_ROUTE%" data-kt-action="update_row">-->
        <a href="{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%').'/'. $%OBJETO_VARIABLE%->%FIELD_ID% .'/edit' ) }}" class="menu-link px-3">
            Editar
        </a>
        @endif

    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3 %OBJETO_DELETE%">
        @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_delete') ) )
        <form id="destroy_%OBJETO_ROUTE%_form_{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" name="destroy_%OBJETO_ROUTE%_form_{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" class="form destroy_%OBJETO_ROUTE%_form" action="{{ route('crud.%OBJETO_ROUTE%.destroy', $%OBJETO_ROUTE%) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-link btn-xs menu-link fs-7  ms-3 px-3" data-kt-%OBJETO_ROUTE%-id="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" data-kt-action="delete_row" value="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}">
                Eliminar
            </button>
        </form>
        @endif

    </div>
    <!--end::Menu item-->

    @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_read') ) )
    @foreach($documentos as $key => $documento)
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url($documento. $%OBJETO%->%FIELD_ID% ) }}" class="menu-link px-3" target="_blank">
            Pdf: {{ $key }}
        </a>
    </div>
    <!--end::Menu item-->
    @endforeach
    @endif
</div>
<!--end::Menu-->