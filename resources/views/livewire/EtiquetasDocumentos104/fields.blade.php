<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">alias</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="alias" name="alias" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="alias" />
      <!--end::Input-->
      @error('alias')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">tabla</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="tabla" name="tabla" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="tabla" />
      <!--end::Input-->
      @error('tabla')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">campo</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="campo" name="campo" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="campo" />
      <!--end::Input-->
      @error('campo')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>