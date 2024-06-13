<div class="row">  <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idopcion</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idopcion" name="idopcion" class="form-select mb-3 mb-lg-0" placeholder="idopcion" />
                    <option value="">-</option>
                    @foreach($Opciones as $item)
                    <option value="{{ $item->idopcion }}">{{ $item->opcion}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idopcion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idmenu</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idmenu" name="idmenu" class="form-select mb-3 mb-lg-0" placeholder="idmenu" />
                    <option value="">-</option>
                    @foreach($Menues as $item)
                    <option value="{{ $item->idmenu }}">{{ $item->menu}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idmenu')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">posicion</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="posicion" name="posicion" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="posicion" />
      <!--end::Input-->
      @error('posicion')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">estatus</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="checkbox" wire:model="estatus" name="estatus" class="form-check-input mb-3 mb-lg-0" placeholder="estatus" value="{{  (isset($estatus)?$estatus:0) }}" />
      <!--end::Input-->
      @error('estatus')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>