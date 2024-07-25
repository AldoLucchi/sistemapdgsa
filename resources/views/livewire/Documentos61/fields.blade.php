<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">nombre</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="nombre" name="nombre" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="nombre" />
      <!--end::Input-->
      @error('nombre')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">documento</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="html" wire:model="documento" name="documento" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="documento" />
      <!--end::Input-->
      @error('documento')
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
  </div>