// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_UsuariosRoles4', [this.getAttribute('data-kt-UsuariosRoles4-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_UsuariosRoles4', [this.getAttribute('data-kt-UsuariosRoles4-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the UsuariosRoles4-table datatable
    LaravelDataTables['UsuariosRoles4-table'].ajax.reload();
});
