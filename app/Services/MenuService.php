<?php

namespace App\Services;

use App\Models\MenuesAsignados101;
use Illuminate\Support\Facades\Auth;

class MenuService
{

    public function getMenuDashboard()
    {
        $menues = $this->getMenu();
        return  $menues;
    }

    public function getMenuProyecto()
    {
        $menues = $this->getMenu();
        return  $menues;
    }

    public function getMenu()
    {
        $menues = [];

        $menu_asignados_all = MenuesAsignados101::all();
        $user = Auth::user();
        $id_proyecto_seleccionado = session()->get('idproyecto');

        //if ($user && $user->cliente) {
        // if ($user->cliente->menues_asignados) {
        // $menues_asignados = $user->cliente->menues_asignados; //->orderBy('posicion', 'asc')->get();
        foreach ($menu_asignados_all as $menu_asignado) {
            if ($menu_asignado->estatus) {
                //if ((!$proyecto_id && !$menu_asignado->idproyecto) || ($proyecto_id && (!$menu_asignado->idproyecto || $menu_asignado->idproyecto == $proyecto_id))) {

                if (!$menu_asignado->idcliente && !$menu_asignado->idrol && !$menu_asignado->idproyecto) {
                    $menues[] = $this->agregarItemMenu($menu_asignado);
                } elseif ($menu_asignado->idcliente && $menu_asignado->idrol && $menu_asignado->idproyecto) {
                    if ($menu_asignado->idcliente == $user->idcliente && $menu_asignado->idrol == $user->idrol && $id_proyecto_seleccionado &&  $id_proyecto_seleccionado == $menu_asignado->idproyecto) {
                        $menues[] = $this->agregarItemMenu($menu_asignado);
                    }
                } elseif ($menu_asignado->idcliente && $menu_asignado->idrol && !$menu_asignado->idproyecto) {
                    if ($menu_asignado->idcliente == $user->idcliente && $menu_asignado->idrol == $user->idrol) {
                        $menues[] = $this->agregarItemMenu($menu_asignado);
                    }
                } elseif ($menu_asignado->idcliente && !$menu_asignado->idrol && !$menu_asignado->idproyecto) {
                    if ($menu_asignado->idcliente == $user->idcliente) {
                        $menues[] = $this->agregarItemMenu($menu_asignado);
                    }
                }
                //}
            }
        }
        //  }
        //   }

        return   $menues;
    }

    public function agregarItemMenu($menu_asignado)
    {
        if ($menu_asignado->menu) {
            $menu_ruta = $menu_asignado->menu->ruta;
            $menu_nombre = $menu_asignado->menu->menu;

            $items = [];
            if ($menu_asignado->menu->opciones) {
                foreach ($menu_asignado->menu->opciones as $opcion) {
                    $ruta_laravel = substr($opcion->ruta, 1);
                    $ruta_laravel = $ruta_laravel . '.';
                    $ruta_laravel = str_replace("/", ".", $ruta_laravel);
                    $items[] = [
                        'nombre' => $opcion->opcion,
                        'ruta' => $opcion->ruta,
                        'ruta_laravel' => $ruta_laravel,
                        'posicion' => $opcion->pivot->posicion,
                        'tipo' => 'opcion',
                    ];
                }
            }

            if ($menu_asignado->menu->cruds) {
                foreach ($menu_asignado->menu->cruds as $crud) {
                    $items[] = [
                        'nombre' => $crud->alias_opcion,
                        'ruta' => $crud->nombre_componente,
                        'posicion' => $crud->pivot->posicion,
                        'tipo' => 'crud',
                    ];
                }
            }

            usort($items, fn ($a, $b) => $a['posicion'] <=> $b['posicion']);

            return [
                'nombre' => $menu_nombre,
                'ruta' => $menu_ruta,
                'items' => $items
            ];
        }
    }
}
