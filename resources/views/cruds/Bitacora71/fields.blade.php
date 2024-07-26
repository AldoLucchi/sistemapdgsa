<div class="mb-10 col-12 col-lg-6">
    <label for="idbitacora" class="form-label">idbitacora</label>

    <input type="number" name="idbitacora" id="idbitacora" class="form-control form-control-solid" placeholder="idbitacora" value="{{ ( isset($Bitacora71)?$Bitacora71->idbitacora:'') }}" readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="crud" class="form-label">crud</label>
    <input type="text" name="crud" id="crud" class="form-control form-control-solid" placeholder="crud" value="{{ ( isset($Bitacora71)?$Bitacora71->crud:'') }}" />

</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="tabla" class="form-label">tabla</label>

    <input type="text" name="tabla" id="tabla" class="form-control form-control-solid" placeholder="tabla" value="{{ ( isset($Bitacora71)?$Bitacora71->tabla:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="id" class="form-label">id</label>

    <input type="number" name="id" id="id" class="form-control form-control-solid" placeholder="id" value="{{ ( isset($Bitacora71)?$Bitacora71->id:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="campoid" class="form-label">campoid</label>

    <input type="text" name="campoid" id="campoid" class="form-control form-control-solid" placeholder="campoid" value="{{ ( isset($Bitacora71)?$Bitacora71->campoid:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idaccion" class="form-label">idaccion</label>
    <select name="idaccion" id="idaccion" class="form-select mb-3 mb-lg-0" placeholder="idaccion">
        <option value="">-</option>

        @foreach($BitacorasAcciones as $item)
        <option value="{{ $item->idaccion }}" {{ (isset($Bitacora71) && $item->idaccion == $Bitacora71->idaccion)?"selected":"" }}>{{ $item->accion }}</option>
        @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="descripcion" class="form-label">descripcion</label>

    <input type="text" name="descripcion" id="descripcion" class="form-control form-control-solid" placeholder="descripcion" value="{{ ( isset($Bitacora71)?$Bitacora71->descripcion:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idproyecto" class="form-label">idproyecto</label>
    <select name="idproyecto" id="idproyecto" class="form-select mb-3 mb-lg-0" placeholder="idproyecto">
        <option value="">-</option>

        @foreach($Proyectos as $item)
        <option value="{{ $item->idproyecto }}" {{ (isset($Bitacora71) && $item->idproyecto == $Bitacora71->idproyecto)?"selected":"" }}>{{ $item->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="idcliente" class="form-label">idcliente</label>
    <select name="idcliente" id="idcliente" class="form-select mb-3 mb-lg-0" placeholder="idcliente">
        <option value="">-</option>

        @foreach($Clientes as $item)
        <option value="{{ $item->idcliente }}" {{ (isset($Bitacora71) && $item->idcliente == $Bitacora71->idcliente)?"selected":"" }}>{{ $item->nombre }}</option>
        @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="ip" class="form-label">ip</label>

    <input type="text" name="ip" id="ip" class="form-control form-control-solid" placeholder="ip" value="{{ ( isset($Bitacora71)?$Bitacora71->ip:'') }}" />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="fecha" class="form-label">fecha</label>

    <input type="datetime-local" name="fecha" id="fecha" class="form-control form-control-solid" placeholder="fecha" value="{{ ( isset($Bitacora71)?$Bitacora71->fecha:'') }}" />
</div>