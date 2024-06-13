<?php

namespace App\Livewire\Opciones98;

use App\Models\Opciones98;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddOpciones98Modal extends Component
{
    use WithFileUploads;
 
    
            public $idopcion;
            
            public $opcion;
            
            public $ruta;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Opciones98' => 'deleteOpciones98',
        'update_Opciones98' => 'updateOpciones98',
        'new_Opciones98' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Opciones98.add-Opciones98-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddOpciones98Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idopcion = $data->data->idopcion;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->opcion) ){
            $data [ "opcion" ] = $this->opcion;  
            } 
            if(  isset( $this->ruta) ){
            $data [ "ruta" ] = $this->ruta;  
            }
            
            $Opciones98 = Opciones98::where('idopcion', $this->idopcion)->first() ?? Opciones98::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Opciones98->$k = $v;
                }
                $Opciones98->save();
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

    public function deleteOpciones98($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Opciones98::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateOpciones98($id)
    {
        Log::info('updateOpciones98');

        $this->edit_mode = true;

        $Opciones98 = Opciones98::find($id);

        Log::info($Opciones98 );

        
            $this->idopcion = $Opciones98->idopcion;
            
            $this->opcion = $Opciones98->opcion;
            
            $this->ruta = $Opciones98->ruta;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
