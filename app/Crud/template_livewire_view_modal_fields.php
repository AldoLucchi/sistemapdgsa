  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">%FIELD%</label>
      <!--end::Label-->
      <!--begin::Input-->
      %INPUT_FIELD%
      <!--end::Input-->
      @error('%FIELD%')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  