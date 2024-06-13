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
      <label class="required fw-semibold fs-6 mb-2">email</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="email" />
      <!--end::Input-->
      @error('email')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">password</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="password" wire:model="password" name="password" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="password" />
      <!--end::Input-->
      @error('password')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idcliente</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idcliente" name="idcliente" class="form-select mb-3 mb-lg-0" placeholder="idcliente" />
                    <option value="">-</option>
                    @foreach($Clientes as $item)
                    <option value="{{ $item->idcliente }}">{{ $item->nombre}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idcliente')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>