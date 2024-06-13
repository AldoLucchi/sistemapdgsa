<div class="modal fade" id="kt_modal_edit_crud" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered  modal-xl ">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_crud_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Editar CRUD</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross','fs-1') !!}
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="kt_modal_edit_crud_form" class="form" action="{{ route('admin.crud.update', $crud_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="crud_id" value="{{ $crud_id }}"/>


                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_edit_crud_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_crud_header" data-kt-scroll-wrappers="#kt_modal_edit_crud_scroll" data-kt-scroll-offset="300px">
                    <div class="row">
                        <!--begin::Input group-->
                        <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Tabla</label>
                            <!--end::Label-->
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror                            

                            <!--begin::Crud-->
                            <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $nombre }}" placeholder="" readonly/>
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->

                         <!--begin::Input group-->
                         <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Nombre componente</label>
                            <!--end::Label-->
                            @error('nombre')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror                            

                            <!--begin::Crud-->
                            <input type="text" class="form-control" name="nombre_componente" id="nombre_componente" value="{{ $nombre_componente }}" placeholder="" readonly/>
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                         <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Alias opción</label>
                            <!--end::Label-->
                            @error('alias_opcion')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            <!--begin::Crud-->
                            <input type="text" class="form-control" name="alias_opcion" id="alias_opcion" value="{{ $alias_opcion }}" placeholder=""/>
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-7 col-12 col-lg-6">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Estatus</label>
                            <!--end::Label-->
                            @error('estatus')
                            <span class="text-danger">{{ $message }}</span> 
                            @enderror
                            <!--begin::Crud-->
                            <input type="checkbox" class="" name="estatus" id="estatus" value="{{ $estatus }}" {{ ($estatus?'checked':'') }} placeholder="" />
                            <!--end::Crud-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    </div>
                    <!--end::Scroll-->

                    

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close" wire:loading.attr="disabled">Cancelar</button>
                        <button type="submit" class="btn btn-primary" data-kt-crud-modal-action="submit">
                            <span class="indicator-label" wire:loading.remove>Guardar</span>
                            <span class="indicator-progress" wire:loading wire:target="submit">
                                Espere...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

