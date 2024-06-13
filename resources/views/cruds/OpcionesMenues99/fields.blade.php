<div class="mb-10 col-12 col-lg-6">
    <label for="idopcionnmenu" class="form-label">idopcionnmenu</label>
    <input type="text" class="form-control form-control-solid" placeholder="idopcionnmenu" value="{{ $OpcionesMenues99->idopcionnmenu }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idopcion" class="form-label">idopcion</label>
    <input type="text" class="form-control form-control-solid" placeholder="idopcion" value="{{ $OpcionesMenues99->Opciones->first()?->opcion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idmenu" class="form-label">idmenu</label>
    <input type="text" class="form-control form-control-solid" placeholder="idmenu" value="{{ $OpcionesMenues99->Menues->first()?->menu }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="posicion" class="form-label">posicion</label>
    <input type="text" class="form-control form-control-solid" placeholder="posicion" value="{{ $OpcionesMenues99->posicion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="estatus" class="form-label">estatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="estatus" value="{{ ($OpcionesMenues99->estatus?"ON":"OFF") }}" readonly/>
</div>
