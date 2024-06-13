<?php

namespace App\Livewire\Users13;

use App\Models\Users13;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosRoles;

class AddUsers13Modal extends Component
{
    use WithFileUploads;
 
    
                public $id;
                
                public $name;
                
                public $email;
                
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
        'delete_Users13' => 'deleteUsers13',
        'update_Users13' => 'updateUsers13',
        'new_Users13' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
        ];

        return view('livewire.Users13.add-Users13-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers13Modal - submit');
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
            
            $Users13 = Users13::where('id', $this->id)->first() ?? Users13::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users13->$k = $v;
                }
                $Users13->save();
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

    public function deleteUsers13($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users13::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers13($id)
    {
        Log::info('updateUsers13');

        $this->edit_mode = true;

        $Users13 = Users13::find($id);

        Log::info($Users13 );

        
            $this->id = $Users13->id;
            
            $this->name = $Users13->name;
            
            $this->email = $Users13->email;
            
            $this->password = $Users13->password;
            
            $this->avatar = $Users13->avatar;
            
            $this->idcliente = $Users13->idcliente;
            
            $this->nombre = $Users13->nombre;
            
            $this->apellido = $Users13->apellido;
            
            $this->cedula = $Users13->cedula;
            
            $this->movilpersonal = $Users13->movilpersonal;
            
            $this->movilempresa = $Users13->movilempresa;
            
            $this->foto = $Users13->foto;
            
            $this->firma = $Users13->firma;
            
            $this->observaciones = $Users13->observaciones;
            
            $this->idestatus = $Users13->idestatus;
            
            $this->insertar = $Users13->insertar;
            
            $this->editar = $Users13->editar;
            
            $this->listar = $Users13->listar;
            
            $this->eliminar = $Users13->eliminar;
            
            $this->imprimir = $Users13->imprimir;
            
            $this->admin = $Users13->admin;
            
            $this->idrol = $Users13->idrol;
            
            $this->codigocrm = $Users13->codigocrm;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
