<div class="mb-10 col-12 col-lg-6">
    <label for="idusuarioproyecto" class="form-label">idusuarioproyecto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idusuarioproyecto" value="{{ $UsuariosProyectos6->idusuarioproyecto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idusuario" class="form-label">idusuario</label>
    <input type="text" class="form-control form-control-solid" placeholder="idusuario" value="{{ $UsuariosProyectos6->Users->first()?->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idproyecto" class="form-label">idproyecto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idproyecto" value="{{ $UsuariosProyectos6->Proyectos->first()?->idcliente }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $UsuariosProyectos6->Clientes->first()?->nombre }}" readonly/>
</div>
