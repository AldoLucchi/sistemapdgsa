 

    <!--begin::Menu item-->
    <div class="menu-item px-3 %OBJETO_UPDATE%">
        @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_update') ) )
        <!--<a href="#" class="menu-link px-3" data-kt-%OBJETO_ROUTE%-id="{{ $%OBJETO_VARIABLE%->%FIELD_ID% }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_%OBJETO_ROUTE%" data-kt-action="update_row">-->
        <a href="{{ url('/'.(Session::has('%OBJETO_ROUTE%')?Session::get('%OBJETO_ROUTE%'):'crud/%OBJETO_ROUTE%').'/'. $%OBJETO_VARIABLE%->%FIELD_ID% .'/edit' ) }}{{ (!in_array('%OBJETO_VARIABLE%',request()->segments()))? ('?redirect_url='.url()->previous()) : ''}}" class="menu-link px-3">
        <i class="fa fa-edit fs-4"></i>
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
            <button type="submit" class="btn btn-link btn-xs menu-link fs-7  ms-3 px-3" data-kt-%OBJETO_ROUTE%-id="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" data-kt-action="delete_row" value="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}">
                 <i class="fa fa-trash-can fs-4"></i>
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
          <i class="fa fa-file-pdf fs-4"></i> <!-- {{ $key }} -->
        </a>
    </div>
    <!--end::Menu item-->
    @endforeach
    @endif
