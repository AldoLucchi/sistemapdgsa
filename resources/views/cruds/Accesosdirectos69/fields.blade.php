<div class="mb-10 col-12 col-lg-6">
    <label for="idaccesodirecto" class="form-label">idaccesodirecto</label>

    <input type="number" name="idaccesodirecto" id="idaccesodirecto" class="form-control form-control-solid" placeholder="idaccesodirecto" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->idaccesodirecto:'') }}" readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="titulo" class="form-label">titulo</label>

    <input type="text" name="titulo" id="titulo" class="form-control form-control-solid" placeholder="titulo" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->titulo:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idaccesodirectotipo" class="form-label">idaccesodirectotipo</label>

    <input type="number" name="idaccesodirectotipo" id="idaccesodirectotipo" class="form-control form-control-solid" placeholder="idaccesodirectotipo" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->idaccesodirectotipo:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="icono" class="form-label">icono</label>

    @if( isset($Accesosdirectos69) && $Accesosdirectos69->icono )
    <br>
    <a href="/images/{{ $Accesosdirectos69->icono }}" target="_blank">
        <img src="/images/{{ $Accesosdirectos69->icono }}" style="width:250px;">
    </a>
    @endif

    <input type="file" name="icono_file" id="icono_file" class="form-control form-control-solid" placeholder="icono" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->icono:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="url" class="form-label">url</label>

    <input type="text" name="url" id="url" class="form-control form-control-solid" placeholder="url" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->url:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcrud" class="form-label">idcrud</label>
    <select name="idcrud" id="idcrud" class="form-select mb-3 mb-lg-0" placeholder="idcrud">
        <option value="">-</option>
        @foreach($CrudsGenerados as $item)
        <option value="{{ $item->id }}" {{ (isset($Accesosdirectos69) && $item->id == $Accesosdirectos69->idcrud)?"selected":"" }}>{{ $item->nombre_componente.' | '.$item->alias_opcion  .' | '.$item->nombre   }}</option>
        @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idrol" class="form-label">idrol</label>
    <select name="idrol" id="idrol" class="form-select mb-3 mb-lg-0" placeholder="idrol">
        <option value="">-</option>
        @foreach($roles as $item)
        <option value="{{ $item->idrol }}" {{ (isset($Accesosdirectos69) && $item->idrol == $Accesosdirectos69->idrol)?"selected":"" }}>{{ $item->rol  }}</option>
        @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idusuario" class="form-label">idusuario</label>
    <select name="idusuario" id="idusuario" class="form-select mb-3 mb-lg-0" placeholder="idusuario">
        <option value="">-</option>
        @foreach($usuarios as $item)
        <option value="{{ $item->id }}" {{ (isset($Accesosdirectos69) && $item->id == $Accesosdirectos69->idusuario)?"selected":"" }}>{{ $item->name  }}</option>
        @endforeach
    </select>
</div>