<?php



        use App\Http\Controllers\Crud\Proyectos15Controller;
        Route::name('testjardines.')->group(function () {
            Route::resource('/testjardines/Proyectos15', Proyectos15Controller::class);
        }); 
        
