<?php

namespace App\Livewire\UsuariosRoles4;

use App\Models\UsuariosRoles4;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddUsuariosRoles4Modal extends Component
{
    use WithFileUploads;
 
    
                public $idrol;
                
                public $rol;
                
                public $descripcion;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_UsuariosRoles4' => 'deleteUsuariosRoles4',
        'update_UsuariosRoles4' => 'updateUsuariosRoles4',
        'new_UsuariosRoles4' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.UsuariosRoles4.add-UsuariosRoles4-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsuariosRoles4Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idrol = $data->data->idrol;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->rol) ){
            $data [ "rol" ] = $this->rol;  
            } 
            if(  isset( $this->descripcion) ){
            $data [ "descripcion" ] = $this->descripcion;  
            }
            
            $UsuariosRoles4 = UsuariosRoles4::where('idrol', $this->idrol)->first() ?? UsuariosRoles4::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $UsuariosRoles4->$k = $v;
                }
                $UsuariosRoles4->save();
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

    public function deleteUsuariosRoles4($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        UsuariosRoles4::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsuariosRoles4($id)
    {
        Log::info('updateUsuariosRoles4');

        $this->edit_mode = true;

        $UsuariosRoles4 = UsuariosRoles4::find($id);

        Log::info($UsuariosRoles4 );

        
            $this->idrol = $UsuariosRoles4->idrol;
            
            $this->rol = $UsuariosRoles4->rol;
            
            $this->descripcion = $UsuariosRoles4->descripcion;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
