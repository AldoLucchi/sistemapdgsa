<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>
    <input type="text" class="form-control form-control-solid" placeholder="id" value="{{ $Users4->id }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="name" class="form-label">name</label>
    <input type="text" class="form-control form-control-solid" placeholder="name" value="{{ $Users4->name }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="email" class="form-label">email</label>
    <input type="text" class="form-control form-control-solid" placeholder="email" value="{{ $Users4->email }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="password" class="form-label">password</label>
    <input type="text" class="form-control form-control-solid" placeholder="password" value="{{ "---" }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $Users4->Clientes->first()?->nombre }}" readonly/>
</div>
