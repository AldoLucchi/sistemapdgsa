<div class="mb-10 col-12 col-lg-6">
    <label for="idpermiso" class="form-label">idpermiso</label>
    <input type="text" class="form-control form-control-solid" placeholder="idpermiso" value="{{ $UsuariosPermisos9->idpermiso }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="listar" class="form-label">listar</label>
    <input type="text" class="form-control form-control-solid" placeholder="listar" value="{{ ($UsuariosPermisos9->listar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="insertar" class="form-label">insertar</label>
    <input type="text" class="form-control form-control-solid" placeholder="insertar" value="{{ ($UsuariosPermisos9->insertar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="editar" class="form-label">editar</label>
    <input type="text" class="form-control form-control-solid" placeholder="editar" value="{{ ($UsuariosPermisos9->editar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="eliminar" class="form-label">eliminar</label>
    <input type="text" class="form-control form-control-solid" placeholder="eliminar" value="{{ ($UsuariosPermisos9->eliminar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="acceder" class="form-label">acceder</label>
    <input type="text" class="form-control form-control-solid" placeholder="acceder" value="{{ ($UsuariosPermisos9->acceder?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="imprimir" class="form-label">imprimir</label>
    <input type="text" class="form-control form-control-solid" placeholder="imprimir" value="{{ ($UsuariosPermisos9->imprimir?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idusuario" class="form-label">idusuario</label>
    <input type="text" class="form-control form-control-solid" placeholder="idusuario" value="{{ $UsuariosPermisos9->Usuarios->first()?->idcliente }}" readonly/>
</div>
