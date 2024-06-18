<div class="row">  <!--begin::Input group-->
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
      <label class="required fw-semibold fs-6 mb-2">telefono</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="telefono" name="telefono" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="telefono" />
      <!--end::Input-->
      @error('telefono')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">celular</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="celular" name="celular" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="celular" />
      <!--end::Input-->
      @error('celular')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">whatsapp</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="whatsapp" name="whatsapp" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="whatsapp" />
      <!--end::Input-->
      @error('whatsapp')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">otrotelefono</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="otrotelefono" name="otrotelefono" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="otrotelefono" />
      <!--end::Input-->
      @error('otrotelefono')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">correo</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="correo" name="correo" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="correo" />
      <!--end::Input-->
      @error('correo')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idorigendatos</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idorigendatos" name="idorigendatos" class="form-select mb-3 mb-lg-0" placeholder="idorigendatos" />
                    <option value="">-</option>
                    @foreach($ContactosOrigenesdedatos as $item)
                    <option value="{{ $item->idorigendedato }}">{{ $item->origendedato}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idorigendatos')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">fechanacimiento</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="fechanacimiento" name="fechanacimiento" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="fechanacimiento" />
      <!--end::Input-->
      @error('fechanacimiento')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idestadocivil</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idestadocivil" name="idestadocivil" class="form-select mb-3 mb-lg-0" placeholder="idestadocivil" />
                    <option value="">-</option>
                    @foreach($ContactosEstadocivil as $item)
                    <option value="{{ $item->idestadocivil }}">{{ $item->estadocivil}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idestadocivil')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">ingresofamiliar</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="number" wire:model="ingresofamiliar" name="ingresofamiliar" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="ingresofamiliar" />
      <!--end::Input-->
      @error('ingresofamiliar')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idprovincia</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idprovincia" name="idprovincia" class="form-select mb-3 mb-lg-0" placeholder="idprovincia" />
                    <option value="">-</option>
                    @foreach($ContactosProvincias as $item)
                    <option value="{{ $item->idprovincia }}">{{ $item->provincia}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idprovincia')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idformacontacto</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idformacontacto" name="idformacontacto" class="form-select mb-3 mb-lg-0" placeholder="idformacontacto" />
                    <option value="">-</option>
                    @foreach($ContactosFormascontacto as $item)
                    <option value="{{ $item->idformacotacto }}">{{ $item->formacontacto}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idformacontacto')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">horario</label>
      <!--end::Label-->
      <!--begin::Input-->
      <input type="text" wire:model="horario" name="horario" class="form-control form-control-solid mb-3 mb-lg-0" placeholder="horario" />
      <!--end::Input-->
      @error('horario')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idvendedor</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idvendedor" name="idvendedor" class="form-select mb-3 mb-lg-0" placeholder="idvendedor" />
                    <option value="">-</option>
                    @foreach($Users as $item)
                    <option value="{{ $item->id }}">{{ $item->name}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idvendedor')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
    <!--begin::Input group-->
  <div class="fv-row mb-7 col-12 col-lg-6">
      <!--begin::Label-->
      <label class="required fw-semibold fs-6 mb-2">idpaso</label>
      <!--end::Label-->
      <!--begin::Input-->
      
                    <select wire:model="idpaso" name="idpaso" class="form-select mb-3 mb-lg-0" placeholder="idpaso" />
                    <option value="">-</option>
                    @foreach($Pasos as $item)
                    <option value="{{ $item->idpaso }}">{{ $item->paso}}</option>
                    @endforeach
                    </select>
                    
      <!--end::Input-->
      @error('idpaso')
      <span class="text-danger">{{ $message }}</span> @enderror
  </div>
  <!--end::Input group-->
  </div>