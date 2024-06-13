// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {
            Livewire.dispatch('delete_%OBJETO_VIEW%', [this.getAttribute('data-kt-%OBJETO_VARIABLE%-id')]);
        }
    });
});

// Add click event listener to update buttons
document.querySelectorAll('[data-kt-action="update_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        Livewire.dispatch('update_%OBJETO_VIEW%', [this.getAttribute('data-kt-%OBJETO_VARIABLE%-id')]);
    });
});

// Listen for 'success' event emitted by Livewire
Livewire.on('success', (message) => {
    // Reload the %OBJETO_VIEW%-table datatable
    LaravelDataTables['%OBJETO_VIEW%-table'].ajax.reload();
});
