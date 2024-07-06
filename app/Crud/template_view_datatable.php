<div class="container">
    <div class="card">
        <div class="card-header">%OBJETO_VARIABLE%</div>
        <div class="card-body">
            {{ $%OBJETO_DATATABLE%->table() }}
        </div>
    </div>
</div>

{{ $%OBJETO_DATATABLE%->scripts() }}