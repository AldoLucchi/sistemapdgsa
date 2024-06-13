<?php

namespace App\Livewire\Clientes4;

use App\Models\Clientes4;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddClientes4Modal extends Component
{
    use WithFileUploads;
 
    
            public $idcliente;
            
            public $nombre;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Clientes4' => 'deleteClientes4',
        'update_Clientes4' => 'updateClientes4',
        'new_Clientes4' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Clientes4.add-Clientes4-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddClientes4Modal - submit');
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
            
            $Clientes4 = Clientes4::where('idcliente', $this->idcliente)->first() ?? Clientes4::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Clientes4->$k = $v;
                }
                $Clientes4->save();
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

    public function deleteClientes4($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Clientes4::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateClientes4($id)
    {
        Log::info('updateClientes4');

        $this->edit_mode = true;

        $Clientes4 = Clientes4::find($id);

        Log::info($Clientes4 );

        
            $this->idcliente = $Clientes4->idcliente;
            
            $this->nombre = $Clientes4->nombre;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
