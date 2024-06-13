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
    <!--begin::Input group-->
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
      <label class="required fw-semibold fs-6 mb-2">apellido</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="apellido" name="apellido" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="apellido" />
      <!--end::Input-->
      @error('apellido')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">cedula</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="cedula" name="cedula" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="cedula" />
      <!--end::Input-->
      @error('cedula')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">movilpersonal</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="movilpersonal" name="movilpersonal" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="movilpersonal" />
      <!--end::Input-->
      @error('movilpersonal')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">movilempresa</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="movilempresa" name="movilempresa" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="movilempresa" />
      <!--end::Input-->
      @error('movilempresa')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">observaciones</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="observaciones" name="observaciones" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="observaciones" />
      <!--end::Input-->
      @error('observaciones')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idestatus</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idestatus" name="idestatus" class="form-select mb-3 mb-lg-0" placeholder="idestatus" />
                    <option value="">-</option>
                    @foreach($UsuariosEstatus as $item)
                    <option value="{{ $item->idestatus }}">{{ $item->estatus}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idestatus')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idrol</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idrol" name="idrol" class="form-select mb-3 mb-lg-0" placeholder="idrol" />
                    <option value="">-</option>
                    @foreach($UsuariosRoles as $item)
                    <option value="{{ $item->idrol }}">{{ $item->rol}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idrol')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>