<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">name</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="name" name="name" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="name" />
      <!--end::Input-->
      @error('name')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">admin</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="admin" name="admin" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="admin" />
      <!--end::Input-->
      @error('admin')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>