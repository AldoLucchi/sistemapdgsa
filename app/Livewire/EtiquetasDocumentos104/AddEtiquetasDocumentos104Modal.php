<?php

namespace App\Livewire\EtiquetasDocumentos104;

use App\Models\EtiquetasDocumentos104;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddEtiquetasDocumentos104Modal extends Component
{
    use WithFileUploads;
 
    
                public $idetiquetadocumento;
                
                public $alias;
                
                public $tabla;
                
                public $campo;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_EtiquetasDocumentos104' => 'deleteEtiquetasDocumentos104',
        'update_EtiquetasDocumentos104' => 'updateEtiquetasDocumentos104',
        'new_EtiquetasDocumentos104' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.EtiquetasDocumentos104.add-EtiquetasDocumentos104-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddEtiquetasDocumentos104Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idetiquetadocumento = $data->data->idetiquetadocumento;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->alias) ){
            $data [ "alias" ] = $this->alias;  
            } 
            if(  isset( $this->tabla) ){
            $data [ "tabla" ] = $this->tabla;  
            } 
            if(  isset( $this->campo) ){
            $data [ "campo" ] = $this->campo;  
            }
            
            $EtiquetasDocumentos104 = EtiquetasDocumentos104::where('idetiquetadocumento', $this->idetiquetadocumento)->first() ?? EtiquetasDocumentos104::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $EtiquetasDocumentos104->$k = $v;
                }
                $EtiquetasDocumentos104->save();
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

    public function deleteEtiquetasDocumentos104($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        EtiquetasDocumentos104::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateEtiquetasDocumentos104($id)
    {
        Log::info('updateEtiquetasDocumentos104');

        $this->edit_mode = true;

        $EtiquetasDocumentos104 = EtiquetasDocumentos104::find($id);

        Log::info($EtiquetasDocumentos104 );

        
            $this->idetiquetadocumento = $EtiquetasDocumentos104->idetiquetadocumento;
            
            $this->alias = $EtiquetasDocumentos104->alias;
            
            $this->tabla = $EtiquetasDocumentos104->tabla;
            
            $this->campo = $EtiquetasDocumentos104->campo;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
