<div class="row">  <!--begin::Input group-->
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
      <label class="required fw-semibold fs-6 mb-2">acceder</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="acceder" name="acceder" class="form-check-input mb-3 mb-lg-0" placeholder="acceder" />
      <!--end::Input-->
      @error('acceder')
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
      <label class="required fw-semibold fs-6 mb-2">idusuario</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idusuario" name="idusuario" class="form-select mb-3 mb-lg-0" placeholder="idusuario" />
                    <option value="">-</option>
                    @foreach($Users as $item)
                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idusuario')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>