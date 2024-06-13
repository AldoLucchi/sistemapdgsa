<div class="mb-10 col-12 col-lg-6">
    <label for="idproyecto" class="form-label">idproyecto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idproyecto" value="{{ $Proyectos14->idproyecto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Proyectos14->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Proyectos14->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idusuario" class="form-label">idusuario</label>
    <input type="text" class="form-control form-control-solid" placeholder="idusuario" value="{{ $Proyectos14->Usuarios->first()?->idcliente }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="logo" class="form-label">logo</label>
    <input type="text" class="form-control form-control-solid" placeholder="logo" value="{{ $Proyectos14->logo }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="direccion" class="form-label">direccion</label>
    <input type="text" class="form-control form-control-solid" placeholder="direccion" value="{{ $Proyectos14->direccion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Proyectos14->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="identificadorcontrato" class="form-label">identificadorcontrato</label>
    <input type="text" class="form-control form-control-solid" placeholder="identificadorcontrato" value="{{ $Proyectos14->identificadorcontrato }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idconstructora" class="form-label">idconstructora</label>
    <input type="text" class="form-control form-control-solid" placeholder="idconstructora" value="{{ $Proyectos14->idconstructora }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="fincamadre" class="form-label">fincamadre</label>
    <input type="text" class="form-control form-control-solid" placeholder="fincamadre" value="{{ $Proyectos14->fincamadre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="codigoubicacion" class="form-label">codigoubicacion</label>
    <input type="text" class="form-control form-control-solid" placeholder="codigoubicacion" value="{{ $Proyectos14->codigoubicacion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="codigocrm" class="form-label">codigocrm</label>
    <input type="text" class="form-control form-control-solid" placeholder="codigocrm" value="{{ $Proyectos14->codigocrm }}" readonly/>
</div>
