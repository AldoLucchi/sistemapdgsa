<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>
    <input type="text" class="form-control form-control-solid" placeholder="id" value="{{ $Users6->id }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control form-control-solid" placeholder="name" value="{{ $Users6->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control form-control-solid" placeholder="email" value="{{ $Users6->email }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control form-control-solid" placeholder="password" value="{{ --- }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Users6->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="nombre" class="form-label">nombre</label>
    <input type="text" class="form-control form-control-solid" placeholder="nombre" value="{{ $Users6->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="apellido" class="form-label">apellido</label>
    <input type="text" class="form-control form-control-solid" placeholder="apellido" value="{{ $Users6->apellido }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="cedula" class="form-label">cedula</label>
    <input type="text" class="form-control form-control-solid" placeholder="cedula" value="{{ $Users6->cedula }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilpersonal" class="form-label">movilpersonal</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilpersonal" value="{{ $Users6->movilpersonal }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="movilempresa" class="form-label">movilempresa</label>
    <input type="text" class="form-control form-control-solid" placeholder="movilempresa" value="{{ $Users6->movilempresa }}" readonly/>
</div>
