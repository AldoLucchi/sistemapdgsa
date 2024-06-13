<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Usuarios1->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Usuarios1->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control form-control-solid" placeholder="apellido" value="{{ $Usuarios1->apellido }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="cedula" class="form-label">cedula</label>
    <input type="text" class="form-control form-control-solid" placeholder="cedula" value="{{ $Usuarios1->cedula }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilpersonal" class="form-label">movilpersonal</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilpersonal" value="{{ $Usuarios1->movilpersonal }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilempresa" class="form-label">movilempresa</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilempresa" value="{{ $Usuarios1->movilempresa }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="foto" class="form-label">foto</label>
    <input type="text" class="form-control form-control-solid" placeholder="foto" value="{{ $Usuarios1->foto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="correo" class="form-label">correo</label>
    <input type="text" class="form-control form-control-solid" placeholder="correo" value="{{ $Usuarios1->correo }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="clave" class="form-label">clave</label>
    <input type="text" class="form-control form-control-solid" placeholder="clave" value="{{ $Usuarios1->clave }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="firma" class="form-label">firma</label>
    <input type="text" class="form-control form-control-solid" placeholder="firma" value="{{ $Usuarios1->firma }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="observaciones" class="form-label">observaciones</label>
    <input type="text" class="form-control form-control-solid" placeholder="observaciones" value="{{ $Usuarios1->observaciones }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Usuarios1->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="admin" class="form-label">admin</label>
    <input type="text" class="form-control form-control-solid" placeholder="admin" value="{{ $Usuarios1->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <input type="text" class="form-control form-control-solid" placeholder="idrol" value="{{ $Usuarios1->UsuariosRoles->first()?->rol }}" readonly/>
</div>
