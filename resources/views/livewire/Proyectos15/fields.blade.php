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
      <label class="required fw-semibold fs-6 mb-2">idcliente</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="idcliente" name="idcliente" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="idcliente" />
      <!--end::Input-->
      @error('idcliente')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">logo</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="logo" name="logo" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="logo" />
      <!--end::Input-->
      @error('logo')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">direccion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="direccion" name="direccion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="direccion" />
      <!--end::Input-->
      @error('direccion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idestatus</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="idestatus" name="idestatus" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="idestatus" />
      <!--end::Input-->
      @error('idestatus')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">identificadorcontrato</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="identificadorcontrato" name="identificadorcontrato" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="identificadorcontrato" />
      <!--end::Input-->
      @error('identificadorcontrato')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">codigoubicacion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="codigoubicacion" name="codigoubicacion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="codigoubicacion" />
      <!--end::Input-->
      @error('codigoubicacion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>