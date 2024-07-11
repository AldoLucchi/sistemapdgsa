// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_EtiquetasDocumentos104', [this.getAttribute('data-kt-EtiquetasDocumentos104-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_EtiquetasDocumentos104', [this.getAttribute('data-kt-EtiquetasDocumentos104-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the EtiquetasDocumentos104-table datatable
    LaravelDataTables['EtiquetasDocumentos104-table'].ajax.reload();
});
