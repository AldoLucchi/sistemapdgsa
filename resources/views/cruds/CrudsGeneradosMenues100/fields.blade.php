<div class="mb-10 col-12 col-lg-6">
    <label for="idcrudgenmenu" class="form-label">idcrudgenmenu</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcrudgenmenu" value="{{ $CrudsGeneradosMenues100->idcrudgenmenu }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcrudgen" class="form-label">idcrudgen</label>
    <input type="text" class="form-control form-control-solid" placeholder="idcrudgen" value="{{ $CrudsGeneradosMenues100->CrudsGenerados->first()?->nombre }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idmenu" class="form-label">idmenu</label>
    <input type="text" class="form-control form-control-solid" placeholder="idmenu" value="{{ $CrudsGeneradosMenues100->Menues->first()?->menu }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="posicion" class="form-label">posicion</label>
    <input type="text" class="form-control form-control-solid" placeholder="posicion" value="{{ $CrudsGeneradosMenues100->posicion }}" readonly/>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="estatus" class="form-label">estatus</label>
    <input type="text" class="form-control form-control-solid" placeholder="estatus" value="{{ ($CrudsGeneradosMenues100->estatus?"ON":"OFF") }}" readonly/>
</div>
