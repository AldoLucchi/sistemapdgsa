<?php

namespace App\Livewire\Users8;

use App\Models\Users8;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosRoles;

class AddUsers8Modal extends Component
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
        'delete_Users8' => 'deleteUsers8',
        'update_Users8' => 'updateUsers8',
        'new_Users8' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
        ];

        return view('livewire.Users8.add-Users8-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers8Modal - submit');
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
            
            $Users8 = Users8::where('id', $this->id)->first() ?? Users8::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users8->$k = $v;
                }
                $Users8->save();
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

    public function deleteUsers8($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users8::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers8($id)
    {
        Log::info('updateUsers8');

        $this->edit_mode = true;

        $Users8 = Users8::find($id);

        Log::info($Users8 );

        
            $this->id = $Users8->id;
            
            $this->name = $Users8->name;
            
            $this->email = $Users8->email;
            
            $this->password = $Users8->password;
            
            $this->idcliente = $Users8->idcliente;
            
            $this->nombre = $Users8->nombre;
            
            $this->apellido = $Users8->apellido;
            
            $this->cedula = $Users8->cedula;
            
            $this->movilpersonal = $Users8->movilpersonal;
            
            $this->movilempresa = $Users8->movilempresa;
            
            $this->observaciones = $Users8->observaciones;
            
            $this->idestatus = $Users8->idestatus;
            
            $this->idrol = $Users8->idrol;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
