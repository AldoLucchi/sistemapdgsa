<div class="mb-10 col-12 col-lg-6">
    <label for="idaccion" class="form-label">idaccion</label>
    
    <input type="number" name="idaccion" id="idaccion" class="form-control form-control-solid" placeholder="idaccion" value="{{ ( isset($BitacorasAcciones70)?$BitacorasAcciones70->idaccion:"") }}"  readonly />
</div>
<div class="mb-10 col-12 col-lg-6">
    <label for="accion" class="form-label">accion</label>
    
    <input type="text" name="accion" id="accion" class="form-control form-control-solid" placeholder="accion" value="{{ ( isset($BitacorasAcciones70)?$BitacorasAcciones70->accion:"") }}"   />
</div>
