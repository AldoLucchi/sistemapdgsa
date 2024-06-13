<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>
    <input type="text" class="form-control form-control-solid" placeholder="id" value="{{ $Users12->id }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control form-control-solid" placeholder="name" value="{{ $Users12->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control form-control-solid" placeholder="email" value="{{ $Users12->email }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="profile_photo_path" class="form-label">profile_photo_path</label>
    <input type="text" class="form-control form-control-solid" placeholder="profile_photo_path" value="{{ $Users12->profile_photo_path }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email_verified_at" class="form-label">email_verified_at</label>
    <input type="text" class="form-control form-control-solid" placeholder="email_verified_at" value="{{ $Users12->email_verified_at }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control form-control-solid" placeholder="password" value="{{ "---" }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="avatar" class="form-label">avatar</label>
    <input type="text" class="form-control form-control-solid" placeholder="avatar" value="{{ $Users12->avatar }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Users12->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Users12->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control form-control-solid" placeholder="apellido" value="{{ $Users12->apellido }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="cedula" class="form-label">cedula</label>
    <input type="text" class="form-control form-control-solid" placeholder="cedula" value="{{ $Users12->cedula }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilpersonal" class="form-label">movilpersonal</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilpersonal" value="{{ $Users12->movilpersonal }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilempresa" class="form-label">movilempresa</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilempresa" value="{{ $Users12->movilempresa }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="foto" class="form-label">foto</label>
    <input type="text" class="form-control form-control-solid" placeholder="foto" value="{{ $Users12->foto }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="firma" class="form-label">firma</label>
    <input type="text" class="form-control form-control-solid" placeholder="firma" value="{{ $Users12->firma }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="observaciones" class="form-label">observaciones</label>
    <input type="text" class="form-control form-control-solid" placeholder="observaciones" value="{{ $Users12->observaciones }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Users12->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="insertar" class="form-label">insertar</label>
    <input type="text" class="form-control form-control-solid" placeholder="insertar" value="{{ ($Users12->insertar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="editar" class="form-label">editar</label>
    <input type="text" class="form-control form-control-solid" placeholder="editar" value="{{ ($Users12->editar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="listar" class="form-label">listar</label>
    <input type="text" class="form-control form-control-solid" placeholder="listar" value="{{ ($Users12->listar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="eliminar" class="form-label">eliminar</label>
    <input type="text" class="form-control form-control-solid" placeholder="eliminar" value="{{ ($Users12->eliminar?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="imprimir" class="form-label">imprimir</label>
    <input type="text" class="form-control form-control-solid" placeholder="imprimir" value="{{ ($Users12->imprimir?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="admin" class="form-label">admin</label>
    <input type="text" class="form-control form-control-solid" placeholder="admin" value="{{ $Users12->admin }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <input type="text" class="form-control form-control-solid" placeholder="idrol" value="{{ $Users12->UsuariosRoles->first()?->rol }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="codigocrm" class="form-label">codigocrm</label>
    <input type="text" class="form-control form-control-solid" placeholder="codigocrm" value="{{ $Users12->codigocrm }}" readonly/>
</div>
