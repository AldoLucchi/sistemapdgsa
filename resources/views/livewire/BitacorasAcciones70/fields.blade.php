<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">accion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="accion" name="accion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="accion" />
      <!--end::Input-->
      @error('accion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>