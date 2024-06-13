<?php

namespace App\Livewire\Users6;

use App\Models\Users6;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;

class AddUsers6Modal extends Component
{
    use WithFileUploads;
 
    
            public $id;
            
            public $name;
            
            public $email;
            
            public $password;
            
            public $idcliente;
            
            public $nombre;
            
            public $apellido;
            
            public $cedula;
            
            public $movilpersonal;
            
            public $movilempresa;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Users6' => 'deleteUsers6',
        'update_Users6' => 'updateUsers6',
        'new_Users6' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
        ];

        return view('livewire.Users6.add-Users6-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers6Modal - submit');
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
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            } 
            if(  isset( $this->apellido) ){
            $data [ "apellido" ] = $this->apellido;  
            } 
            if(  isset( $this->cedula) ){
            $data [ "cedula" ] = $this->cedula;  
            } 
            if(  isset( $this->movilpersonal) ){
            $data [ "movilpersonal" ] = $this->movilpersonal;  
            } 
            if(  isset( $this->movilempresa) ){
            $data [ "movilempresa" ] = $this->movilempresa;  
            }
            
            $Users6 = Users6::where('id', $this->id)->first() ?? Users6::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users6->$k = $v;
                }
                $Users6->save();
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

    public function deleteUsers6($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users6::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers6($id)
    {
        Log::info('updateUsers6');

        $this->edit_mode = true;

        $Users6 = Users6::find($id);

        Log::info($Users6 );

        
            $this->id = $Users6->id;
            
            $this->name = $Users6->name;
            
            $this->email = $Users6->email;
            
            $this->password = $Users6->password;
            
            $this->idcliente = $Users6->idcliente;
            
            $this->nombre = $Users6->nombre;
            
            $this->apellido = $Users6->apellido;
            
            $this->cedula = $Users6->cedula;
            
            $this->movilpersonal = $Users6->movilpersonal;
            
            $this->movilempresa = $Users6->movilempresa;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
