<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Proyectos3->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Proyectos3->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="logo" class="form-label">logo</label>
    <input type="text" class="form-control form-control-solid" placeholder="logo" value="{{ $Proyectos3->logo }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="direccion" class="form-label">direccion</label>
    <input type="text" class="form-control form-control-solid" placeholder="direccion" value="{{ $Proyectos3->direccion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Proyectos3->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="identificadorcontrato" class="form-label">identificadorcontrato</label>
    <input type="text" class="form-control form-control-solid" placeholder="identificadorcontrato" value="{{ $Proyectos3->identificadorcontrato }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="fincamadre" class="form-label">fincamadre</label>
    <input type="text" class="form-control form-control-solid" placeholder="fincamadre" value="{{ $Proyectos3->fincamadre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="codigoubicacion" class="form-label">codigoubicacion</label>
    <input type="text" class="form-control form-control-solid" placeholder="codigoubicacion" value="{{ $Proyectos3->codigoubicacion }}" readonly/>
</div>
