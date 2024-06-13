// Home > Dashboard > %MENU% > %OBJETO%
Breadcrumbs::for('%OBJETO_ROUTE%.index', function (BreadcrumbTrail $trail) {
    $trail->parent('%MENU%.index');
    $trail->push('%OBJETO_LABEL%', route('%MENU%.%OBJETO_ROUTE%.index'));
});

use App\Models\%OBJETO%;

Breadcrumbs::for('%OBJETO_ROUTE%.show', function (BreadcrumbTrail $trail, %OBJETO% $%OBJETO_VARIABLE%) {
    $trail->parent('%MENU%.index');
    $trail->push('%OBJETO_LABEL% Detalle', route('%MENU%.%OBJETO_ROUTE%.show', $%OBJETO_VARIABLE%));
});

