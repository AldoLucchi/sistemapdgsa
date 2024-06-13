<a href="#" class="btn btn-light btn-active-light-primary btn-flex btn-center btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
    Acción
    <i class="ki-duotone ki-down fs-5 ms-1"></i>
</a>
<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="{{ url('/admin/Users5/'. $Users5->id ) }}" class="menu-link px-3">
            Ver
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-Users5-id="{{ $Users5->id }}" data-bs-toggle="modal" data-bs-target="#kt_modal_add_Users5" data-kt-action="update_row">
            Editar
        </a>
    </div>
    <!--end::Menu item-->

    <!--begin::Menu item-->
    <div class="menu-item px-3">
        <a href="#" class="menu-link px-3" data-kt-Users5-id="{{ $Users5->id }}" data-kt-action="delete_row">
            Eliminar
        </a>
    </div>
    <!--end::Menu item-->
</div>
<!--end::Menu-->

