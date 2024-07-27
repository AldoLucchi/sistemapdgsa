<?php

namespace App\Http\Controllers;

use App\Models\Proyectos;
use App\Services\MenuService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Services\AccesoDirectoService;
use App\Services\BitacoraService;

class DashboardController extends Controller
{
    protected $menuService;
    protected $accesoDirectoService;
    protected $bitacoraService;

    public function __construct(
        MenuService $menuService,
        AccesoDirectoService $accesoDirectoService,
        BitacoraService $bitacoraService
    ) {
        $this->menuService = $menuService;
        $this->accesoDirectoService = $accesoDirectoService;
        $this->bitacoraService = $bitacoraService;
    }

    public function index()
    {
        Log::info('DashboardController - user logged: ' . Auth::user()->id . ' - ' . Auth::user()->name);

        $user = Auth::user();
        $proyectos = [];
        $idusuario = null;

        //if ($user && $user->cliente && $user->cliente->proyectos) {
          //  $proyectos = $user->cliente->proyectos;
        if ($user && $user->proyectos) {
                $proyectos = $user->proyectos;            
        }

        if ($user && $user->rol) {
            if ($user->rol->idvisibilidad > 1) {
                $idusuario = $user->id;
            }
        }

        $menues = $this->menuService->getMenuDashboard();
        $accesodDirectos = $this->accesoDirectoService->getAccesoDirectos();

        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }


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

        $sysdate = date('Y-m-d H:i:s');

        $data = [
            'idaccion' => 6, //proyecto
            'descripcion' => 'login exitoso '.Auth::user()->email,
            'ip' => $this->getIP(),
            'idproyecto' => $id,
            'fecha' => $sysdate,
        ];
        $this->bitacoraService->insertBitacora($data);

        return view('pages/dashboards.dashboard-proyecto', $data);
    }

    public function getIP(){
        $ip = '';
        if (isset($_SERVER['SERVER_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        } elseif (isset($_SERVER['LOCAL_ADDR'])) {
            $ip = $_SERVER['SERVER_ADDR'];
        }

        return $ip;
    }
}
