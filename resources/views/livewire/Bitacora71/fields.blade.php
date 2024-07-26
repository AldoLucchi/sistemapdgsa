<div class="row">  <!--begin::Input group-->
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
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">id</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="id" name="id" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="id" />
      <!--end::Input-->
      @error('id')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">campoid</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="campoid" name="campoid" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="campoid" />
      <!--end::Input-->
      @error('campoid')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idaccion</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idaccion" name="idaccion" class="form-select mb-3 mb-lg-0" placeholder="idaccion" />
                    <option value="">-</option>
                    @foreach($BitacorasAcciones as $item)
                    <option value="{{ $item->idaccion }}">{{ $item->accion}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idaccion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">descripcion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="descripcion" name="descripcion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="descripcion" />
      <!--end::Input-->
      @error('descripcion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idproyecto</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idproyecto" name="idproyecto" class="form-select mb-3 mb-lg-0" placeholder="idproyecto" />
                    <option value="">-</option>
                    @foreach($Proyectos as $item)
                    <option value="{{ $item->idproyecto }}">{{ $item->nombre}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idproyecto')
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
      <label class="required fw-semibold fs-6 mb-2">ip</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="ip" name="ip" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ip" />
      <!--end::Input-->
      @error('ip')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">fecha</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="datetime-local" wire:model="fecha" name="fecha" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="fecha" />
      <!--end::Input-->
      @error('fecha')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>