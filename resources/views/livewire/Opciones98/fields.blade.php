<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">opcion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="opcion" name="opcion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="opcion" />
      <!--end::Input-->
      @error('opcion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">ruta</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="ruta" name="ruta" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ruta" />
      <!--end::Input-->
      @error('ruta')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>