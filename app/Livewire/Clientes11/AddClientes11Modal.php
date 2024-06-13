<?php

namespace App\Livewire\Clientes11;

use App\Models\Clientes11;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddClientes11Modal extends Component
{
    use WithFileUploads;
 
    
                public $idcliente;
                
                public $nombre;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Clientes11' => 'deleteClientes11',
        'update_Clientes11' => 'updateClientes11',
        'new_Clientes11' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Clientes11.add-Clientes11-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddClientes11Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idcliente = $data->data->idcliente;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            }
            
            $Clientes11 = Clientes11::where('idcliente', $this->idcliente)->first() ?? Clientes11::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Clientes11->$k = $v;
                }
                $Clientes11->save();
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

    public function deleteClientes11($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Clientes11::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateClientes11($id)
    {
        Log::info('updateClientes11');

        $this->edit_mode = true;

        $Clientes11 = Clientes11::find($id);

        Log::info($Clientes11 );

        
            $this->idcliente = $Clientes11->idcliente;
            
            $this->nombre = $Clientes11->nombre;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
