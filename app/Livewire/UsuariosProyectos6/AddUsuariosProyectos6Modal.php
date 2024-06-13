<?php

namespace App\Livewire\UsuariosProyectos6;

use App\Models\UsuariosProyectos6;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Users;
                use App\Models\Proyectos;
                use App\Models\Clientes;

class AddUsuariosProyectos6Modal extends Component
{
    use WithFileUploads;
 
    
                public $idusuarioproyecto;
                
                public $idusuario;
                
                public $idproyecto;
                
                public $idcliente;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_UsuariosProyectos6' => 'deleteUsuariosProyectos6',
        'update_UsuariosProyectos6' => 'updateUsuariosProyectos6',
        'new_UsuariosProyectos6' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Users" => Users::all(),
                
                "Proyectos" => Proyectos::all(),
                
                "Clientes" => Clientes::all(),
                
        ];

        return view('livewire.UsuariosProyectos6.add-UsuariosProyectos6-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsuariosProyectos6Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idusuarioproyecto = $data->data->idusuarioproyecto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idusuario) ){
            $data [ "idusuario" ] = $this->idusuario;  
            } 
            if(  isset( $this->idproyecto) ){
            $data [ "idproyecto" ] = $this->idproyecto;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            }
            
            $UsuariosProyectos6 = UsuariosProyectos6::where('idusuarioproyecto', $this->idusuarioproyecto)->first() ?? UsuariosProyectos6::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $UsuariosProyectos6->$k = $v;
                }
                $UsuariosProyectos6->save();
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

    public function deleteUsuariosProyectos6($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        UsuariosProyectos6::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsuariosProyectos6($id)
    {
        Log::info('updateUsuariosProyectos6');

        $this->edit_mode = true;

        $UsuariosProyectos6 = UsuariosProyectos6::find($id);

        Log::info($UsuariosProyectos6 );

        
            $this->idusuarioproyecto = $UsuariosProyectos6->idusuarioproyecto;
            
            $this->idusuario = $UsuariosProyectos6->idusuario;
            
            $this->idproyecto = $UsuariosProyectos6->idproyecto;
            
            $this->idcliente = $UsuariosProyectos6->idcliente;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
