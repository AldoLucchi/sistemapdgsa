<div class="container">
    <div class="card">
        <div class="card-header">%OBJETO_VARIABLE%D</div>
        <div class="card-body">
            {{ $dataTable%OBJETO_VARIABLE%D->table() }}
        </div>
    </div>
</div>

{{ $dataTable%OBJETO_VARIABLE%D->scripts() }}