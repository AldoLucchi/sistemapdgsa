<div class="mb-10 col-12 col-lg-6">
    <label for="idnmenuasignado" class="form-label">idnmenuasignado</label>
    <input type="text" class="form-control form-control-solid" placeholder="idnmenuasignado" value="{{ $MenuesAsignados101->idnmenuasignado }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idmenu" class="form-label">idmenu</label>
    <input type="text" class="form-control form-control-solid" placeholder="idmenu" value="{{ $MenuesAsignados101->Menues->first()?->menu }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcliente" value="{{ $MenuesAsignados101->Clientes->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <input type="text" class="form-control form-control-solid" placeholder="idrol" value="{{ $MenuesAsignados101->UsuariosRoles->first()?->rol }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="estatus" class="form-label">estatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="estatus" value="{{ ($MenuesAsignados101->estatus?"ON":"OFF") }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idproyecto" class="form-label">idproyecto</label>
    <input type="text" class="form-control form-control-solid" placeholder="idproyecto" value="{{ $MenuesAsignados101->Proyectos->first()?->idcliente }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="posicion" class="form-label">posicion</label>
    <input type="text" class="form-control form-control-solid" placeholder="posicion" value="{{ $MenuesAsignados101->posicion }}" readonly/>
</div>
