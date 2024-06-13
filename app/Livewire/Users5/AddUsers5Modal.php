<?php

namespace App\Livewire\Users5;

use App\Models\Users5;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosRoles;

class AddUsers5Modal extends Component
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
                
                public $observaciones;
                
                public $idestatus;
                
                public $idrol;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Users5' => 'deleteUsers5',
        'update_Users5' => 'updateUsers5',
        'new_Users5' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
        ];

        return view('livewire.Users5.add-Users5-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers5Modal - submit');
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
            if(  isset( $this->observaciones) ){
            $data [ "observaciones" ] = $this->observaciones;  
            } 
            if(  isset( $this->idestatus) ){
            $data [ "idestatus" ] = $this->idestatus;  
            } 
            if(  isset( $this->idrol) ){
            $data [ "idrol" ] = $this->idrol;  
            }
            
            $Users5 = Users5::where('id', $this->id)->first() ?? Users5::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users5->$k = $v;
                }
                $Users5->save();
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

    public function deleteUsers5($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users5::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers5($id)
    {
        Log::info('updateUsers5');

        $this->edit_mode = true;

        $Users5 = Users5::find($id);

        Log::info($Users5 );

        
            $this->id = $Users5->id;
            
            $this->name = $Users5->name;
            
            $this->email = $Users5->email;
            
            $this->password = $Users5->password;
            
            $this->idcliente = $Users5->idcliente;
            
            $this->nombre = $Users5->nombre;
            
            $this->apellido = $Users5->apellido;
            
            $this->cedula = $Users5->cedula;
            
            $this->movilpersonal = $Users5->movilpersonal;
            
            $this->movilempresa = $Users5->movilempresa;
            
            $this->observaciones = $Users5->observaciones;
            
            $this->idestatus = $Users5->idestatus;
            
            $this->idrol = $Users5->idrol;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
