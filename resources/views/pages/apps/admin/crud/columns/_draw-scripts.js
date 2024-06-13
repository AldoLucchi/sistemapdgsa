// Initialize KTMenu
KTMenu.init();



// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_crud', [this.getAttribute('data-kt-crud-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the crud-table datatable
    LaravelDataTables['crud-table'].ajax.reload();
});
