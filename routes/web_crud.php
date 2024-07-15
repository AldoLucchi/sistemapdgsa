<?php




        

        use App\Http\Controllers\Crud\Contactos4Controller;
        Route::name('crm.')->group(function () {
            Route::resource('/crm/Contactos4', Contactos4Controller::class);
        }); 
        Route::get('crm/Contactos4DataTable',[Contactos4Controller::class, 'getContactos4DataTable'])->name('crm.Contactos4DataTable');
        Route::get('crm/Contactos4DataTable/create',[Contactos4Controller ::class, 'create'])->name('Contactos4DataTable.create');

                
