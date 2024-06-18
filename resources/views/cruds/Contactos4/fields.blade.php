<div class="mb-10 col-12 col-lg-6">
    <label for="idcontacto" class="form-label">idcontacto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcontacto" value="{{ $Contactos4->idcontacto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Contactos4->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="telefono" class="form-label">telefono</label>
    <input type="text" class="form-control form-control-solid" placeholder="telefono" value="{{ $Contactos4->telefono }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="celular" class="form-label">celular</label>
    <input type="text" class="form-control form-control-solid" placeholder="celular" value="{{ $Contactos4->celular }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="whatsapp" class="form-label">whatsapp</label>
    <input type="text" class="form-control form-control-solid" placeholder="whatsapp" value="{{ $Contactos4->whatsapp }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="otrotelefono" class="form-label">otrotelefono</label>
    <input type="text" class="form-control form-control-solid" placeholder="otrotelefono" value="{{ $Contactos4->otrotelefono }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="correo" class="form-label">correo</label>
    <input type="text" class="form-control form-control-solid" placeholder="correo" value="{{ $Contactos4->correo }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idorigendatos" class="form-label">idorigendatos</label>
    <input type="text" class="form-control form-control-solid" placeholder="idorigendatos" value="{{ $Contactos4->ContactosOrigenesdedatos->first()?->origendedato }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="fechanacimiento" class="form-label">fechanacimiento</label>
    <input type="text" class="form-control form-control-solid" placeholder="fechanacimiento" value="{{ $Contactos4->fechanacimiento }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestadocivil" class="form-label">idestadocivil</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestadocivil" value="{{ $Contactos4->ContactosEstadocivil->first()?->estadocivil }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="ingresofamiliar" class="form-label">ingresofamiliar</label>
    <input type="text" class="form-control form-control-solid" placeholder="ingresofamiliar" value="{{ $Contactos4->ingresofamiliar }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idprovincia" class="form-label">idprovincia</label>
    <input type="text" class="form-control form-control-solid" placeholder="idprovincia" value="{{ $Contactos4->ContactosProvincias->first()?->provincia }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idformacontacto" class="form-label">idformacontacto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idformacontacto" value="{{ $Contactos4->ContactosFormascontacto->first()?->formacontacto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="horario" class="form-label">horario</label>
    <input type="text" class="form-control form-control-solid" placeholder="horario" value="{{ $Contactos4->horario }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idvendedor" class="form-label">idvendedor</label>
    <input type="text" class="form-control form-control-solid" placeholder="idvendedor" value="{{ $Contactos4->Users->first()?->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idpaso" class="form-label">idpaso</label>
    <input type="text" class="form-control form-control-solid" placeholder="idpaso" value="{{ $Contactos4->Pasos->first()?->paso }}" readonly/>
</div>
