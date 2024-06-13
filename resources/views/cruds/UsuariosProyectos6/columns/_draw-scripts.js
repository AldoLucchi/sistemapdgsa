// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_UsuariosProyectos6', [this.getAttribute('data-kt-UsuariosProyectos6-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_UsuariosProyectos6', [this.getAttribute('data-kt-UsuariosProyectos6-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the UsuariosProyectos6-table datatable
    LaravelDataTables['UsuariosProyectos6-table'].ajax.reload();
});
