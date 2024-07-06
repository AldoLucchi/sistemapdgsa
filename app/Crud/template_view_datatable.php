<div class="container">
    <div class="card">
        <div class="card-header">%OBJETO_VARIABLE%</div>
        <div class="card-body">
            {{ $datatable%OBJETO%->table() }}
        </div>
    </div>
</div>

{{ $datatable%OBJETO%->scripts() }}