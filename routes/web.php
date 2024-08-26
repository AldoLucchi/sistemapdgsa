<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirmaController;
use App\Http\Controllers\Api\NotificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/google/redirect', [GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/registrarFirmaCliente/{table}/{idRegister}', [FirmaController::class, 'registrarFirmaCliente'])->name('admin.registrarFirma');
Route::post('/registrarFirmaGenerada', [FirmaController::class, 'registrarFirmaGenerada'])->name('admin.registrarFirmaGenerada');

Route::get('/notificationMarkRead/{notification_id}', [NotificationController::class, 'notificationMarkRead'])->name('notificationMarkRead');

Route::middleware(['auth'])->group(function () { //, 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);
    /* Rutas protegidas */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/accordion', [DashboardController::class, 'accordion'])->name('accordion');
    
    Route::get('/proyectoDetalle/{id}', [DashboardController::class, 'dashboardProyecto'])->name('dashboardProyecto');
    Route::get('/dashboardProyectos', [DashboardController::class, 'dashboardProyectos'])->name('dashboardProyectos');    

    require __DIR__ . '/web_admin.php';

    require __DIR__ . '/web_base.php';

    require __DIR__ . '/web_crud.php';
    
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';


