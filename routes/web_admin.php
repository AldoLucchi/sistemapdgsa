<?php

use App\Http\Controllers\Apps\CrudController;
use App\Http\Controllers\Crud\Accesosdirectos69Controller;
use App\Http\Controllers\Crud\Bitacora71Controller;
use App\Http\Controllers\Crud\BitacorasAcciones70Controller;
use App\Http\Controllers\Crud\CrudsGeneradosMenues100Controller;
use App\Http\Controllers\Crud\Documentos61Controller;
use App\Http\Controllers\Crud\EtiquetasDocumentos104Controller;
use App\Http\Controllers\Crud\Menues97Controller;
use App\Http\Controllers\Crud\MenuesAsignados101Controller;
use App\Http\Controllers\Crud\Opciones98Controller;
use App\Http\Controllers\Crud\OpcionesMenues99Controller;
use App\Http\Controllers\FirmaController;

Route::name('admin.')->group(function () {
    Route::get('/admin/crud', [CrudController::class, 'index'])->name('crud.index');
    Route::get('/admin/crud/create', [CrudController::class, 'create'])->name('crud.create');
    Route::post('/admin/crud', [CrudController::class, 'store'])->name('crud.store');
    Route::get('/admin/crud/{id}/edit', [CrudController::class, 'edit'])->name('crud.edit');
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

    Route::resource('/admin/documento', Documentos61Controller::class);
    Route::get('/generarPdf/{idDocumento}/{idRegister}', [Documentos61Controller::class, 'generarPdf'])->name('admin.generarPdf');
    Route::resource('/admin/etiquetaDocumento', EtiquetasDocumentos104Controller::class);
    Route::get('/admin/getEtiquetaDocumento/{alias}/{id}', [EtiquetasDocumentos104Controller::class, 'getEtiquetaDocumento'])->name('admin.getEtiquetaDocumento');
    
    Route::get('/admin/getDataFirma/{table?}/{idRegister?}', [FirmaController::class, 'getDataFirma'])->name('admin.getDataFirma');
    Route::get('/registrarFirma/{table}/{idRegister}', [FirmaController::class, 'registrarFirma'])->name('admin.registrarFirma');
    Route::post('/registrarFirmaGenerada', [FirmaController::class, 'registrarFirmaGenerada'])->name('admin.registrarFirmaGenerada');

    Route::resource('/admin/accesoDirecto', Accesosdirectos69Controller::class);

    Route::resource('/admin/bitacoraAccion', BitacorasAcciones70Controller::class);

    Route::resource('/admin/bitacora', Bitacora71Controller::class);



});