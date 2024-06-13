<?php

namespace App\Livewire\MenuesAsignados101;

use App\Models\MenuesAsignados101;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Menues;
                use App\Models\Clientes;
                use App\Models\UsuariosRoles;
                use App\Models\Proyectos;

class AddMenuesAsignados101Modal extends Component
{
    use WithFileUploads;
 
    
            public $idnmenuasignado;
            
            public $idmenu;
            
            public $idcliente;
            
            public $idrol;
            
            public bool $estatus;
            
            public $idproyecto;
            
            public $posicion;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_MenuesAsignados101' => 'deleteMenuesAsignados101',
        'update_MenuesAsignados101' => 'updateMenuesAsignados101',
        'new_MenuesAsignados101' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Menues" => Menues::all(),
                
                "Clientes" => Clientes::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
                "Proyectos" => Proyectos::all(),
                
        ];

        return view('livewire.MenuesAsignados101.add-MenuesAsignados101-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddMenuesAsignados101Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idnmenuasignado = $data->data->idnmenuasignado;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idmenu) ){
            $data [ "idmenu" ] = $this->idmenu;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->idrol) ){
            $data [ "idrol" ] = $this->idrol;  
            } 
            if(  isset( $this->estatus) ){
            $data [ "estatus" ] = $this->estatus;  
            } 
            /* else{
                $data [ "estatus" ] = 0;  
                }                 */
            if(  isset( $this->idproyecto) ){
            $data [ "idproyecto" ] = $this->idproyecto;  
            } 
            if(  isset( $this->posicion) ){
            $data [ "posicion" ] = $this->posicion;  
            }
            
            $MenuesAsignados101 = MenuesAsignados101::where('idnmenuasignado', $this->idnmenuasignado)->first() ?? MenuesAsignados101::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $MenuesAsignados101->$k = $v;
                }
                $MenuesAsignados101->save();
            }

            if ($this->edit_mode) {
                // Emit a success event with a message
                $this->dispatch('success', __('Actualizado correctamente!'));
            } else {                

                // Emit a success event with a message
                $this->dispatch('success', __('Creado correctamente!'));
            }
        });

        // Reset the form fields after successful submission
        $this->reset();
    }

    public function deleteMenuesAsignados101($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        MenuesAsignados101::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateMenuesAsignados101($id)
    {
        Log::info('updateMenuesAsignados101');

        $this->edit_mode = true;

        $MenuesAsignados101 = MenuesAsignados101::find($id);

        Log::info($MenuesAsignados101 );

        
            $this->idnmenuasignado = $MenuesAsignados101->idnmenuasignado;
            
            $this->idmenu = $MenuesAsignados101->idmenu;
            
            $this->idcliente = $MenuesAsignados101->idcliente;
            
            $this->idrol = $MenuesAsignados101->idrol;
            
            $this->estatus = $MenuesAsignados101->estatus;
            
            $this->idproyecto = $MenuesAsignados101->idproyecto;
            
            $this->posicion = $MenuesAsignados101->posicion;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
