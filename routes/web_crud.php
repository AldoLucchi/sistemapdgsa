<?php



        use App\Http\Controllers\Crud\Contactos4Controller;
        Route::name('crm.')->group(function () {
            Route::resource('/crm/Contactos4', Contactos4Controller::class);
        }); 
        
