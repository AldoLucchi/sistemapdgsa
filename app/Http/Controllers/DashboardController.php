<?php

namespace App\Http\Controllers;

use App\Models\Proyectos;
use App\Services\MenuService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class DashboardController extends Controller
{
    private $menuService;

    public function __construct(
        MenuService $menuService
    ) {
        $this->menuService = $menuService;
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

        Session::put('idcliente', $user->idcliente);
        Session::put('idrol', $user->idrol);
        Session::put('idusuario', $idusuario);
        Session::put('usuario_proyectos', $proyectos);
        Session::put('menues', $menues);
        Session::put('proyecto_seleccionado', null);

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
            Session::put('proyecto_seleccionado', $proyecto->idproyecto);
            $menues = $this->menuService->getMenuProyecto($proyecto->idproyecto);
            Session::put('menues', $menues);
        } else {
            Session::put('proyecto_seleccionado', null);
        }



        return view('pages/dashboards.dashboard-proyecto', $data);
    }
}
