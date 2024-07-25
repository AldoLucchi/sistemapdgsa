<div class="mb-10 col-12 col-lg-6">
    <label for="idaccesodirecto" class="form-label">idaccesodirecto</label>
    
    <input type="number" name="idaccesodirecto" id="idaccesodirecto" class="form-control form-control-solid" placeholder="idaccesodirecto" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->idaccesodirecto:'') }}"  readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="titulo" class="form-label">titulo</label>
    
    <input type="text" name="titulo" id="titulo" class="form-control form-control-solid" placeholder="titulo" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->titulo:'') }}"   />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idtipo" class="form-label">idtipo</label>
    
    <input type="number" name="idtipo" id="idtipo" class="form-control form-control-solid" placeholder="idtipo" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->idtipo:'') }}"   />
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
    
    <input type="text" name="url" id="url" class="form-control form-control-solid" placeholder="url" value="{{ ( isset($Accesosdirectos69)?$Accesosdirectos69->url:'') }}"   />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcrud" class="form-label">idcrud</label>    
    <select name="idcrud" id="idcrud" class="form-select mb-3 mb-lg-0" placeholder="idcrud">
    <option value="">-</option>
    
                    @foreach($CrudsGenerados as $item)
                    <option value="{{ $item->id }}"  {{ (isset($Accesosdirectos69) && $item->id == $Accesosdirectos69->idcrud)?"selected":"" }}>{{ $item->nombre }}</option>
                    @endforeach
    </select>
</div>
