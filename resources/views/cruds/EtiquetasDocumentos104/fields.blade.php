<div class="mb-10 col-12 col-lg-6">
    <label for="idetiquetadocumento" class="form-label">idetiquetadocumento</label>
    
    <input type="number" name="idetiquetadocumento" id="idetiquetadocumento" class="form-control form-control-solid" placeholder="idetiquetadocumento" value="{{ ( isset($EtiquetasDocumentos104)?$EtiquetasDocumentos104->idetiquetadocumento:"") }}"  readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="alias" class="form-label">alias</label>
    
    <input type="text" name="alias" id="alias" class="form-control form-control-solid" placeholder="alias" value="{{ ( isset($EtiquetasDocumentos104)?$EtiquetasDocumentos104->alias:"") }}"   />
</div>

<div class="mb-10 col-12 col-lg-6">    
    <label for="tabla" class="form-label">tabla</label>    
    <select name="tabla" id="tabla" class="form-select mb-3 mb-lg-0" placeholder="tabla">
    <option value="">-</option>
    @foreach($tablesDatabase as $table)
    <option value="{{ $table }}" {{ (isset($EtiquetasDocumentos104) && $EtiquetasDocumentos104->tabla == $table ?'selected':'' ) }}>{{ $table }}</option>
    @endforeach
    </select>
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="campo" class="form-label">campo</label>
    
    <input type="text" name="campo" id="campo" class="form-control form-control-solid" placeholder="campo" value="{{ ( isset($EtiquetasDocumentos104)?$EtiquetasDocumentos104->campo:"") }}"   />
</div>
