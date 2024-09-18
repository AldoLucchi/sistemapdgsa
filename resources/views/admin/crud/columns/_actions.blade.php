

    <!--begin::Menu item-->
           
        <a href="{{ url('/admin/crud/'. $crud->id .'/edit' ) }}" class="menu-link px-3">
        <i class="fa fa-edit fs-4" title="Editar"></i>
        </a>
    
    <!--end::Menu item-->

    <!--begin::Menu item-->
         
        <a href="{{ url('/admin/crudRefresh/'. $crud->id ) }}" class="menu-link px-3">
        <i class="fa fa-refresh fs-4" title="Refrescar"></i>
        </a>
   
    <!--end::Menu item-->    

    <!--begin::Menu item-->
    
        <a href="#" class="menu-link px-3" data-kt-crud-id="{{ $crud->id }}" data-kt-action="delete_row">
        <i class="fa fa-trash-can fs-4" title="Borrar"></i>
        </a>
    
    <!--end::Menu item-->


