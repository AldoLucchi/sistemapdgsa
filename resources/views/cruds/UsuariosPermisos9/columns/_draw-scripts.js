// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_UsuariosPermisos9', [this.getAttribute('data-kt-UsuariosPermisos9-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_UsuariosPermisos9', [this.getAttribute('data-kt-UsuariosPermisos9-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the UsuariosPermisos9-table datatable
    LaravelDataTables['UsuariosPermisos9-table'].ajax.reload();
});
