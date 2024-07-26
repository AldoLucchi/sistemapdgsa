// Initialize KTMenu
KTMenu.init();

// Add click event listener to delete buttons
document.querySelectorAll('[data-kt-action="delete_row"]').forEach(function (element) {
    element.addEventListener('click', function () {
        if (confirm('Are you sure you want to remove?')) {            
            var selectorForm = '#destroy_Contactos133_form_'+element.value;      
            $(selectorForm).submit();
            return true;
        }        
        return false; 
    });
});




