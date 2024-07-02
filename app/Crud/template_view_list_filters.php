<div class="col-12 col-lg-4">
    <label for="%OBJETO_LABEL_INDIVIDUAL%" class=" form-label">%OBJETO_LABEL%</label>
    <select class="form-control form-select form-select-transparent" aria-label="Select example" id="%OBJETO_LABEL_INDIVIDUAL%" name="%OBJETO_LABEL_INDIVIDUAL%">
        <option value="">---</option>
        @foreach($%OBJETO_LABEL% as $%OBJETO_LABEL_INDIVIDUAL%Option)
        <option value="{{ $%OBJETO_LABEL_INDIVIDUAL%Option->%FIELD_ID% }}">{{ $%OBJETO_LABEL_INDIVIDUAL%Option->%FIELD_NAME% }}</option>
        @endforeach
    </select>
</div>