<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">titulo</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="titulo" name="titulo" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="titulo" />
      <!--end::Input-->
      @error('titulo')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idtipo</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="idtipo" name="idtipo" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="idtipo" />
      <!--end::Input-->
      @error('idtipo')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">icono</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="icono" name="icono" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="icono" />
      <!--end::Input-->
      @error('icono')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">url</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="url" name="url" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="url" />
      <!--end::Input-->
      @error('url')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idcrud</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idcrud" name="idcrud" class="form-select mb-3 mb-lg-0" placeholder="idcrud" />
                    <option value="">-</option>
                    @foreach($CrudsGenerados as $item)
                    <option value="{{ $item->id }}">{{ $item->nombre}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idcrud')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>