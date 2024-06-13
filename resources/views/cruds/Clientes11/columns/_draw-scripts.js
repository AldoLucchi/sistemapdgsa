// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_Clientes11', [this.getAttribute('data-kt-Clientes11-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_Clientes11', [this.getAttribute('data-kt-Clientes11-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the Clientes11-table datatable
    LaravelDataTables['Clientes11-table'].ajax.reload();
});
