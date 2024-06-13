<div>
    <input type="text" wire:model.debounce.300ms="search" placeholder="Buscar usuarios..." class="form-control mb-3" />

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de creación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $usuarios->links() }}
</div>
