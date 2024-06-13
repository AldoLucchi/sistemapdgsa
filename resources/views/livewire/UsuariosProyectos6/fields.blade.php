<div class="row">  <!--begin::Input group-->
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
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idproyecto</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idproyecto" name="idproyecto" class="form-select mb-3 mb-lg-0" placeholder="idproyecto" />
                    <option value="">-</option>
                    @foreach($Proyectos as $item)
                    <option value="{{ $item->idproyecto }}">{{ $item->idcliente}}</option>
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
  </div>