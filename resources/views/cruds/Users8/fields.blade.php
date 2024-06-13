<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>
    <input type="text" class="form-control form-control-solid" placeholder="id" value="{{ $Users8->id }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control form-control-solid" placeholder="name" value="{{ $Users8->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control form-control-solid" placeholder="email" value="{{ $Users8->email }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control form-control-solid" placeholder="password" value="{{ "---" }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Users8->idcliente }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Users8->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control form-control-solid" placeholder="apellido" value="{{ $Users8->apellido }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="cedula" class="form-label">cedula</label>
    <input type="text" class="form-control form-control-solid" placeholder="cedula" value="{{ $Users8->cedula }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilpersonal" class="form-label">movilpersonal</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilpersonal" value="{{ $Users8->movilpersonal }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilempresa" class="form-label">movilempresa</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilempresa" value="{{ $Users8->movilempresa }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="observaciones" class="form-label">observaciones</label>
    <input type="text" class="form-control form-control-solid" placeholder="observaciones" value="{{ $Users8->observaciones }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idestatus" class="form-label">idestatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="idestatus" value="{{ $Users8->UsuariosEstatus->first()?->estatus }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <input type="text" class="form-control form-control-solid" placeholder="idrol" value="{{ $Users8->UsuariosRoles->first()?->rol }}" readonly/>
</div>
