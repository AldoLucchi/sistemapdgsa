 

    <!--begin::Menu item-->
    <div class="menu-item px-3 %OBJETO_DELETE%">
        @if( (request()->segment(2) == '%OBJETO%') || (request()->segment(2) != '%OBJETO%' && Session::has('%OBJETO%_delete') ) )
        <form id="destroy_%OBJETO_ROUTE%_form_{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" name="destroy_%OBJETO_ROUTE%_form_{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" class="form destroy_%OBJETO_ROUTE%_form" action="{{ route('crud.%OBJETO_ROUTE%.destroy', $%OBJETO_ROUTE%) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-link btn-xs menu-link fs-7  ms-3 px-3" data-kt-%OBJETO_ROUTE%-id="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}" data-kt-action="delete_row" value="{{ $%OBJETO_ROUTE%->%FIELD_ID% }}">
                 <i class="far fa-trash-can fs-5"></i>
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
          <i class="far fa-file-pdf fs-5"></i> <!-- {{ $key }} -->
        </a>
    </div>
    <!--end::Menu item-->
    @endforeach
    @endif
