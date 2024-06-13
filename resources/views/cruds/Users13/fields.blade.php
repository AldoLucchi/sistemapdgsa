<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>
    <input type="text" class="form-control form-control-solid" placeholder="id" value="{{ $Users13->id }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control form-control-solid" placeholder="name" value="{{ $Users13->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control form-control-solid" placeholder="email" value="{{ $Users13->email }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control form-control-solid" placeholder="password" value="{{ "---" }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="avatar" class="form-label">avatar</label>
    <input type="text" class="form-control form-control-solid" placeholder="avatar" value="{{ $Users13->avatar }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Users13->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Users13->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control form-control-solid" placeholder="apellido" value="{{ $Users13->apellido }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="cedula" class="form-label">cedula</label>
    <input type="text" class="form-control form-control-solid" placeholder="cedula" value="{{ $Users13->cedula }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilpersonal" class="form-label">movilpersonal</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilpersonal" value="{{ $Users13->movilpersonal }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilempresa" class="form-label">movilempresa</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilempresa" value="{{ $Users13->movilempresa }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="foto" class="form-label">foto</label>
    <input type="text" class="form-control form-control-solid" placeholder="foto" value="{{ $Users13->foto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="firma" class="form-label">firma</label>
    <input type="text" class="form-control form-control-solid" placeholder="firma" value="{{ $Users13->firma }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="observaciones" class="form-label">observaciones</label>
    <input type="text" class="form-control form-control-solid" placeholder="observaciones" value="{{ $Users13->observaciones }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Users13->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="insertar" class="form-label">insertar</label>
    <input type="text" class="form-control form-control-solid" placeholder="insertar" value="{{ ($Users13->insertar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="editar" class="form-label">editar</label>
    <input type="text" class="form-control form-control-solid" placeholder="editar" value="{{ ($Users13->editar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="listar" class="form-label">listar</label>
    <input type="text" class="form-control form-control-solid" placeholder="listar" value="{{ ($Users13->listar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="eliminar" class="form-label">eliminar</label>
    <input type="text" class="form-control form-control-solid" placeholder="eliminar" value="{{ ($Users13->eliminar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="imprimir" class="form-label">imprimir</label>
    <input type="text" class="form-control form-control-solid" placeholder="imprimir" value="{{ ($Users13->imprimir?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="admin" class="form-label">admin</label>
    <input type="text" class="form-control form-control-solid" placeholder="admin" value="{{ $Users13->admin }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <input type="text" class="form-control form-control-solid" placeholder="idrol" value="{{ $Users13->UsuariosRoles->first()?->rol }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="codigocrm" class="form-label">codigocrm</label>
    <input type="text" class="form-control form-control-solid" placeholder="codigocrm" value="{{ $Users13->codigocrm }}" readonly/>
</div>
