<?php

namespace App\Livewire\Proyectos9;

use App\Models\Proyectos9;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddProyectos9Modal extends Component
{
    use WithFileUploads;
 
    
                public $idproyecto;
                
                public $nombre;
                
                public $idestatus;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Proyectos9' => 'deleteProyectos9',
        'update_Proyectos9' => 'updateProyectos9',
        'new_Proyectos9' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Proyectos9.add-Proyectos9-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddProyectos9Modal - submit');
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
                 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            } 
            if(  isset( $this->idestatus) ){
            $data [ "idestatus" ] = $this->idestatus;  
            }
            
            $Proyectos9 = Proyectos9::where('idproyecto', $this->idproyecto)->first() ?? Proyectos9::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Proyectos9->$k = $v;
                }
                $Proyectos9->save();
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

    public function deleteProyectos9($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Proyectos9::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateProyectos9($id)
    {
        Log::info('updateProyectos9');

        $this->edit_mode = true;

        $Proyectos9 = Proyectos9::find($id);

        Log::info($Proyectos9 );

        
            $this->idproyecto = $Proyectos9->idproyecto;
            
            $this->nombre = $Proyectos9->nombre;
            
            $this->idestatus = $Proyectos9->idestatus;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
