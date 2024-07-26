<?php

namespace App\Livewire\BitacorasAcciones70;

use App\Models\BitacorasAcciones70;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddBitacorasAcciones70Modal extends Component
{
    use WithFileUploads;
 
    
                public $idaccion;
                
                public $accion;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_BitacorasAcciones70' => 'deleteBitacorasAcciones70',
        'update_BitacorasAcciones70' => 'updateBitacorasAcciones70',
        'new_BitacorasAcciones70' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.BitacorasAcciones70.add-BitacorasAcciones70-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddBitacorasAcciones70Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idaccion = $data->data->idaccion;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->accion) ){
            $data [ "accion" ] = $this->accion;  
            }
            
            $BitacorasAcciones70 = BitacorasAcciones70::where('idaccion', $this->idaccion)->first() ?? BitacorasAcciones70::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $BitacorasAcciones70->$k = $v;
                }
                $BitacorasAcciones70->save();
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

    public function deleteBitacorasAcciones70($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        BitacorasAcciones70::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateBitacorasAcciones70($id)
    {
        Log::info('updateBitacorasAcciones70');

        $this->edit_mode = true;

        $BitacorasAcciones70 = BitacorasAcciones70::find($id);

        Log::info($BitacorasAcciones70 );

        
            $this->idaccion = $BitacorasAcciones70->idaccion;
            
            $this->accion = $BitacorasAcciones70->accion;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
