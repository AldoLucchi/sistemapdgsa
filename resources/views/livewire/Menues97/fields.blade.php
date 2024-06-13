<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">menu</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="menu" name="menu" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="menu" />
      <!--end::Input-->
      @error('menu')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">estatus</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="estatus" name="estatus" class="form-check-input mb-3 mb-lg-0" placeholder="estatus" value="{{  (isset($estatus)?$estatus:0) }}" />
      <!--end::Input-->
      @error('estatus')
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