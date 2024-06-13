<?php

namespace App\Livewire\Proyectos7;

use App\Models\Proyectos7;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;

class AddProyectos7Modal extends Component
{
    use WithFileUploads;
 
    
                public $idproyecto;
                
                public $idcliente;
                
                public $nombre;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Proyectos7' => 'deleteProyectos7',
        'update_Proyectos7' => 'updateProyectos7',
        'new_Proyectos7' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
        ];

        return view('livewire.Proyectos7.add-Proyectos7-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddProyectos7Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idproyecto = $data->data->idproyecto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            }
            
            $Proyectos7 = Proyectos7::where('idproyecto', $this->idproyecto)->first() ?? Proyectos7::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Proyectos7->$k = $v;
                }
                $Proyectos7->save();
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

    public function deleteProyectos7($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Proyectos7::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateProyectos7($id)
    {
        Log::info('updateProyectos7');

        $this->edit_mode = true;

        $Proyectos7 = Proyectos7::find($id);

        Log::info($Proyectos7 );

        
            $this->idproyecto = $Proyectos7->idproyecto;
            
            $this->idcliente = $Proyectos7->idcliente;
            
            $this->nombre = $Proyectos7->nombre;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
