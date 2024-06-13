Breadcrumbs::for('%MENU%.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('%MENU_LABEL%', route('dashboard'));
});