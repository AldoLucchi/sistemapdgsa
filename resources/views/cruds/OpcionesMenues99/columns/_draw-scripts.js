// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_OpcionesMenues99', [this.getAttribute('data-kt-OpcionesMenues99-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_OpcionesMenues99', [this.getAttribute('data-kt-OpcionesMenues99-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the OpcionesMenues99-table datatable
    LaravelDataTables['OpcionesMenues99-table'].ajax.reload();
});
