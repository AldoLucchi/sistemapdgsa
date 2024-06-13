<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MenuService
{

    public function getMenuDashboard()
    {
        $menues = $this->getMenu();
        return  $menues;
    }

    public function getMenuProyecto($proyecto_id)
    {
        $menues = $this->getMenu($proyecto_id);
        return  $menues;
    }

    public function getMenu($proyecto_id = null)
    {
        $menues = [];

        $user = Auth::user();
        if ($user && $user->cliente) {
            if ($user->cliente->menues_asignados) {
                $menues_asignados = $user->cliente->menues_asignados; //->orderBy('posicion', 'asc')->get();
                foreach ($menues_asignados as $menu_asignado) {
                    if ($menu_asignado->estatus) {
                        if ((!$proyecto_id && !$menu_asignado->idproyecto) || ($proyecto_id && (!$menu_asignado->idproyecto || $menu_asignado->idproyecto == $proyecto_id))) {
                            if ($menu_asignado->menu) {
                                $menu_ruta = $menu_asignado->menu->ruta;
                                $menu_nombre = $menu_asignado->menu->menu;

                                $items = [];
                                if ($menu_asignado->menu->opciones) {
                                    foreach ($menu_asignado->menu->opciones as $opcion) {
                                        $ruta_laravel = substr( $opcion->ruta,1);
                                        $ruta_laravel = $ruta_laravel.'.';
                                        $ruta_laravel = str_replace("/",".",$ruta_laravel);
                                        $items[] = [
                                            'nombre' => $opcion->opcion,
                                            'ruta' => $opcion->ruta,
                                            'ruta_laravel' => $ruta_laravel,
                                            'tipo' => 'opcion',
                                        ];
                                    }
                                }

                                if ($menu_asignado->menu->cruds) {
                                    foreach ($menu_asignado->menu->cruds as $crud) {
                                        $items[] = [
                                            'nombre' => $crud->alias_opcion,
                                            'ruta' => $crud->nombre_componente,
                                            'tipo' => 'crud',
                                        ];
                                    }
                                }

                                $menues[] = [
                                    'nombre' => $menu_nombre,
                                    'ruta' => $menu_ruta,
                                    'items' => $items
                                ];
                            }
                        }
                    }
                }
            }
        }

        return   $menues;
    }
}
