<?php

namespace App\Livewire\Users4;

use App\Models\Users4;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;

class AddUsers4Modal extends Component
{
    use WithFileUploads;
 
    
                public $id;
                
                public $name;
                
                public $email;
                
                public $password;
                
                public $idcliente;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Users4' => 'deleteUsers4',
        'update_Users4' => 'updateUsers4',
        'new_Users4' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
        ];

        return view('livewire.Users4.add-Users4-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers4Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->id = $data->data->id;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->name) ){
            $data [ "name" ] = $this->name;  
            } 
            if(  isset( $this->email) ){
            $data [ "email" ] = $this->email;  
            } 
            if(  isset( $this->password) ){
            $data [ "password" ] = $this->password;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            }
            
            $Users4 = Users4::where('id', $this->id)->first() ?? Users4::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users4->$k = $v;
                }
                $Users4->save();
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

    public function deleteUsers4($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users4::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers4($id)
    {
        Log::info('updateUsers4');

        $this->edit_mode = true;

        $Users4 = Users4::find($id);

        Log::info($Users4 );

        
            $this->id = $Users4->id;
            
            $this->name = $Users4->name;
            
            $this->email = $Users4->email;
            
            $this->password = $Users4->password;
            
            $this->idcliente = $Users4->idcliente;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
