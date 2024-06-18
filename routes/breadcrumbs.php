<?php

use App\Models\CrudsGeneradosMenues100;
use App\Models\Menues97;
use App\Models\MenuesAsignados101;
use App\Models\Opciones98;
use App\Models\OpcionesMenues99;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});




// Home > Dashboard > Admin
Breadcrumbs::for('admin.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('Admin', route('dashboard'));
});


//========================================================


// Home > Dashboard > Admin > Crud
Breadcrumbs::for('admin.crud.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Crud', route('admin.crud.index'));
});

//--------------------------------------------------------
// Home > Dashboard > Admin > Menu
Breadcrumbs::for('admin.menu.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Menu', route('admin.menu.index'));
});

// Home > Dashboard > Admin > Menu > [Menu]
Breadcrumbs::for('admin.menu.show', function (BreadcrumbTrail $trail, Menues97 $menu) {
    $trail->parent('admin.menu.index');
    $trail->push('Detalle Menu', route('admin.menu.show', $menu));
});

//--------------------------------------------------------
// Home > Dashboard > Admin > Opcion
Breadcrumbs::for('admin.opcion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Opcion', route('admin.opcion.index'));
});

// Home > Dashboard > Admin > Opcion > [Opcion]
Breadcrumbs::for('admin.opcion.show', function (BreadcrumbTrail $trail, Opciones98 $opcion) {
    $trail->parent('admin.opcion.index');
    $trail->push('Detalle Opcion', route('admin.opcion.show', $opcion));
});

//--------------------------------------------------------
// Home > Dashboard > Admin > Opcion Menu
Breadcrumbs::for('admin.menuOpcion.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Opcion x Menu', route('admin.menuOpcion.index'));
});

// Home > Dashboard > Admin > MenuOpcion > [MenuOpcion]
Breadcrumbs::for('admin.menuOpcion.show', function (BreadcrumbTrail $trail, OpcionesMenues99 $opcionMenu) {
    $trail->parent('admin.menuOpcion.index');
    $trail->push('Detalle Opcion Menu', route('admin.menuOpcion.show', $opcionMenu));
});

//--------------------------------------------------------
// Home > Dashboard > Admin > Crud Generado Menu
Breadcrumbs::for('admin.menuCrud.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('CRUD generado x Menu', route('admin.menuCrud.index'));
});

// Home > Dashboard > Admin > MenuCrud > [MenuCrud]
Breadcrumbs::for('admin.menuCrud.show', function (BreadcrumbTrail $trail, CrudsGeneradosMenues100 $crudMenu) {
    $trail->parent('admin.menuCrud.index');
    $trail->push('Detalle Crud Menu', route('admin.menuCrud.show', $crudMenu));
});

//--------------------------------------------------------
// Home > Dashboard > Admin > Opcion Menu
Breadcrumbs::for('admin.menuAsignado.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.index');
    $trail->push('Menu Asignado', route('admin.menuAsignado.index'));
});

// Home > Dashboard > Admin > MenuAsignado > [MenuAsignado]
Breadcrumbs::for('admin.menuAsignado.show', function (BreadcrumbTrail $trail, MenuesAsignados101 $menuAsignado) {
    $trail->parent('admin.menuAsignado.index');
    $trail->push('Detalle Menu Asignado', route('admin.menuAsignado.show', $menuAsignado));
});


Breadcrumbs::for('crm.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('CRM', route('dashboard'));
});
// Home > Dashboard > crm > Contactos4
Breadcrumbs::for('Contactos4.index', function (BreadcrumbTrail $trail) {
    $trail->parent('crm.index');
    $trail->push('Contactos Registrados', route('crm.Contactos4.index'));
});

use App\Models\Contactos4;

Breadcrumbs::for('Contactos4.show', function (BreadcrumbTrail $trail, Contactos4 $Contactos4) {
    $trail->parent('crm.index');
    $trail->push('Contactos Registrados Detalle', route('crm.Contactos4.show', $Contactos4));
});


