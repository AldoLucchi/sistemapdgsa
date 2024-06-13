<?php

use App\Http\Controllers\Apps\CrudController;
use App\Http\Controllers\Crud\CrudsGeneradosMenues100Controller;
use App\Http\Controllers\Crud\Menues97Controller;
use App\Http\Controllers\Crud\MenuesAsignados101Controller;
use App\Http\Controllers\Crud\Opciones98Controller;
use App\Http\Controllers\Crud\OpcionesMenues99Controller;

Route::name('admin.')->group(function () {
    Route::get('/admin/crud', [CrudController::class, 'index'])->name('crud.index');
    Route::post('/admin/crud', [CrudController::class, 'store'])->name('crud.store');
    Route::put('/admin/crud', [CrudController::class, 'update'])->name('crud.update');

    /*
    Route::get('/admin/menu', [Menues97Controller::class, 'index'])->name('menu.index');
    Route::get('/admin/opcion', [Opciones98Controller::class, 'index'])->name('opcion.index');
    Route::get('/admin/menuOpcion', [OpcionesMenues99Controller::class, 'index'])->name('menuOpcion.index');
    Route::get('/admin/menuCrud', [CrudsGeneradosMenues100Controller::class, 'index'])->name('menuCrud.index');
    Route::get('/admin/menuAsignado', [MenuesAsignados101Controller::class, 'index'])->name('menuAsignado.index');
    */
    //Route::resource('/user-management/users', UserManagementController::class);
    Route::resource('/admin/menu', Menues97Controller::class);
    Route::resource('/admin/opcion', Opciones98Controller::class);
    Route::resource('/admin/menuOpcion', OpcionesMenues99Controller::class);
    Route::resource('/admin/menuCrud', CrudsGeneradosMenues100Controller::class);
    Route::resource('/admin/menuAsignado', MenuesAsignados101Controller::class);
});