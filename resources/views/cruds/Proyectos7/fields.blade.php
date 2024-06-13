<div class="mb-10 col-12 col-lg-6">
    <label for="idproyecto" class="form-label">idproyecto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idproyecto" value="{{ $Proyectos7->idproyecto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Proyectos7->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Proyectos7->nombre }}" readonly/>
</div>
