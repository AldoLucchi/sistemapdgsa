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
      <label class="required fw-semibold fs-6 mb-2">profile_photo_path</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="profile_photo_path" name="profile_photo_path" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="profile_photo_path" />
      <!--end::Input-->
      @error('profile_photo_path')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">email_verified_at</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="datetime-local" wire:model="email_verified_at" name="email_verified_at" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="email_verified_at" />
      <!--end::Input-->
      @error('email_verified_at')
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
      <label class="required fw-semibold fs-6 mb-2">avatar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="avatar" name="avatar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="avatar" />
      <!--end::Input-->
      @error('avatar')
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
      <label class="required fw-semibold fs-6 mb-2">foto</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="foto" name="foto" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="foto" />
      <!--end::Input-->
      @error('foto')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">firma</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="firma" name="firma" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="firma" />
      <!--end::Input-->
      @error('firma')
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
      <label class="required fw-semibold fs-6 mb-2">insertar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="insertar" name="insertar" class="form-check-input mb-3 mb-lg-0" placeholder="insertar" />
      <!--end::Input-->
      @error('insertar')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">editar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="editar" name="editar" class="form-check-input mb-3 mb-lg-0" placeholder="editar" />
      <!--end::Input-->
      @error('editar')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">listar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="listar" name="listar" class="form-check-input mb-3 mb-lg-0" placeholder="listar" />
      <!--end::Input-->
      @error('listar')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">eliminar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="eliminar" name="eliminar" class="form-check-input mb-3 mb-lg-0" placeholder="eliminar" />
      <!--end::Input-->
      @error('eliminar')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">imprimir</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="imprimir" name="imprimir" class="form-check-input mb-3 mb-lg-0" placeholder="imprimir" />
      <!--end::Input-->
      @error('imprimir')
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
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">codigocrm</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="codigocrm" name="codigocrm" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="codigocrm" />
      <!--end::Input-->
      @error('codigocrm')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>