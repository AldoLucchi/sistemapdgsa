<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">rol</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="rol" name="rol" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="rol" />
      <!--end::Input-->
      @error('rol')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">descripcion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="descripcion" />
      <!--end::Input-->
      @error('descripcion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>