<?php

namespace App\Livewire\Documentos61;

use App\Models\Documentos61;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddDocumentos61Modal extends Component
{
    use WithFileUploads;
 
    
                public $iddocumento;
                
                public $nombre;
                
                public $documento;
                
                public $tabla;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Documentos61' => 'deleteDocumentos61',
        'update_Documentos61' => 'updateDocumentos61',
        'new_Documentos61' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Documentos61.add-Documentos61-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddDocumentos61Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->iddocumento = $data->data->iddocumento;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            } 
            if(  isset( $this->documento) ){
            $data [ "documento" ] = $this->documento;  
            } 
            if(  isset( $this->tabla) ){
            $data [ "tabla" ] = $this->tabla;  
            }
            
            $Documentos61 = Documentos61::where('iddocumento', $this->iddocumento)->first() ?? Documentos61::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Documentos61->$k = $v;
                }
                $Documentos61->save();
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

    public function deleteDocumentos61($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Documentos61::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateDocumentos61($id)
    {
        Log::info('updateDocumentos61');

        $this->edit_mode = true;

        $Documentos61 = Documentos61::find($id);

        Log::info($Documentos61 );

        
            $this->iddocumento = $Documentos61->iddocumento;
            
            $this->nombre = $Documentos61->nombre;
            
            $this->documento = $Documentos61->documento;
            
            $this->tabla = $Documentos61->tabla;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
