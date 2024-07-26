<?php

namespace App\Http\Controllers;

use App\Models\Proyectos;
use App\Services\MenuService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\AccesoDirectoService;

class DashboardController extends Controller
{
    protected $menuService;
    protected $accesoDirectoService;

    public function __construct(
        MenuService $menuService,
        AccesoDirectoService $accesoDirectoService
    ) {
        $this->menuService = $menuService;
        $this->accesoDirectoService = $accesoDirectoService;
    }

    public function index()
    {
        Log::info('DashboardController - user logged: ' . Auth::user()->id . ' - ' . Auth::user()->name);

        $user = Auth::user();
        $proyectos = [];
        $idusuario = null;

        if ($user && $user->cliente && $user->cliente->proyectos) {
            $proyectos = $user->cliente->proyectos;
        }

        if ($user && $user->rol) {
            if ($user->rol->idvisibilidad > 1) {
                $idusuario = $user->id;
            }
        }

        $menues = $this->menuService->getMenuDashboard();
        $accesodDirectos = $this->accesoDirectoService->getAccesoDirectos();

        Session::put('idcliente', $user->idcliente);
        Session::put('idrol', $user->idrol);
        Session::put('idusuario', $idusuario);
        Session::put('usuario_proyectos', $proyectos);
        Session::put('menues', $menues);
        Session::put('proyecto_seleccionado', null);
        Session::put('idproyecto', null);
        Session::put('current_crud', null);
        Session::put('accesos_directos', $accesodDirectos);

        return view('pages/dashboards.index', $proyectos);
    }

    public function accordion()
    {
        $users = User::all();
        return view('pages/dashboards.accordion', compact('users'));
    }

    public function dashboardProyecto($id)
    {
        Log::info('DashboardController - dashboardProyecto - user logged: ' . Auth::user()->id . ' - ' . Auth::user()->name);

        $proyecto = Proyectos::find($id);
        $data = [
            'proyecto' => $proyecto
        ];

        if ($proyecto) {
            Session::put('proyecto_seleccionado', $id);
            Session::put('idproyecto', $id);
            $menues = $this->menuService->getMenuProyecto($proyecto->idproyecto);
            Session::put('menues', $menues);
        } else {
            Session::put('proyecto_seleccionado', null);
            Session::put('idproyecto', null);
        }



        return view('pages/dashboards.dashboard-proyecto', $data);
    }
}
