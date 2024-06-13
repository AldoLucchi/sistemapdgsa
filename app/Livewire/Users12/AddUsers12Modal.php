<?php

namespace App\Livewire\Users12;

use App\Models\Users12;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosRoles;

class AddUsers12Modal extends Component
{
    use WithFileUploads;
 
    
                public $id;
                
                public $name;
                
                public $email;
                
                public $profile_photo_path;
                
                public $email_verified_at;
                
                public $password;
                
                public $avatar;
                
                public $idcliente;
                
                public $nombre;
                
                public $apellido;
                
                public $cedula;
                
                public $movilpersonal;
                
                public $movilempresa;
                
                public $foto;
                
                public $firma;
                
                public $observaciones;
                
                public $idestatus;
                
                public bool $insertar;
                
                public bool $editar;
                
                public bool $listar;
                
                public bool $eliminar;
                
                public bool $imprimir;
                
                public $admin;
                
                public $idrol;
                
                public $codigocrm;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Users12' => 'deleteUsers12',
        'update_Users12' => 'updateUsers12',
        'new_Users12' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
        ];

        return view('livewire.Users12.add-Users12-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers12Modal - submit');
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
            if(  isset( $this->profile_photo_path) ){
            $data [ "profile_photo_path" ] = $this->profile_photo_path;  
            } 
            if(  isset( $this->email_verified_at) ){
            $data [ "email_verified_at" ] = $this->email_verified_at;  
            } 
            if(  isset( $this->password) ){
            $data [ "password" ] = $this->password;  
            } 
            if(  isset( $this->avatar) ){
            $data [ "avatar" ] = $this->avatar;  
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
            if(  isset( $this->foto) ){
            $data [ "foto" ] = $this->foto;  
            } 
            if(  isset( $this->firma) ){
            $data [ "firma" ] = $this->firma;  
            } 
            if(  isset( $this->observaciones) ){
            $data [ "observaciones" ] = $this->observaciones;  
            } 
            if(  isset( $this->idestatus) ){
            $data [ "idestatus" ] = $this->idestatus;  
            } 
            if(  isset( $this->insertar) ){
            $data [ "insertar" ] = $this->insertar;  
            } 
                else{
                $data [ "insertar" ] = 0;  
                } 
            if(  isset( $this->editar) ){
            $data [ "editar" ] = $this->editar;  
            } 
                else{
                $data [ "editar" ] = 0;  
                } 
            if(  isset( $this->listar) ){
            $data [ "listar" ] = $this->listar;  
            } 
                else{
                $data [ "listar" ] = 0;  
                } 
            if(  isset( $this->eliminar) ){
            $data [ "eliminar" ] = $this->eliminar;  
            } 
                else{
                $data [ "eliminar" ] = 0;  
                } 
            if(  isset( $this->imprimir) ){
            $data [ "imprimir" ] = $this->imprimir;  
            } 
                else{
                $data [ "imprimir" ] = 0;  
                } 
            if(  isset( $this->admin) ){
            $data [ "admin" ] = $this->admin;  
            } 
            if(  isset( $this->idrol) ){
            $data [ "idrol" ] = $this->idrol;  
            } 
            if(  isset( $this->codigocrm) ){
            $data [ "codigocrm" ] = $this->codigocrm;  
            }
            
            $Users12 = Users12::where('id', $this->id)->first() ?? Users12::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users12->$k = $v;
                }
                $Users12->save();
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

    public function deleteUsers12($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users12::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers12($id)
    {
        Log::info('updateUsers12');

        $this->edit_mode = true;

        $Users12 = Users12::find($id);

        Log::info($Users12 );

        
            $this->id = $Users12->id;
            
            $this->name = $Users12->name;
            
            $this->email = $Users12->email;
            
            $this->profile_photo_path = $Users12->profile_photo_path;
            
            $this->email_verified_at = $Users12->email_verified_at;
            
            $this->password = $Users12->password;
            
            $this->avatar = $Users12->avatar;
            
            $this->idcliente = $Users12->idcliente;
            
            $this->nombre = $Users12->nombre;
            
            $this->apellido = $Users12->apellido;
            
            $this->cedula = $Users12->cedula;
            
            $this->movilpersonal = $Users12->movilpersonal;
            
            $this->movilempresa = $Users12->movilempresa;
            
            $this->foto = $Users12->foto;
            
            $this->firma = $Users12->firma;
            
            $this->observaciones = $Users12->observaciones;
            
            $this->idestatus = $Users12->idestatus;
            
            $this->insertar = $Users12->insertar;
            
            $this->editar = $Users12->editar;
            
            $this->listar = $Users12->listar;
            
            $this->eliminar = $Users12->eliminar;
            
            $this->imprimir = $Users12->imprimir;
            
            $this->admin = $Users12->admin;
            
            $this->idrol = $Users12->idrol;
            
            $this->codigocrm = $Users12->codigocrm;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
