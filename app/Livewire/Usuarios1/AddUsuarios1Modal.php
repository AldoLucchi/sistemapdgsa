<?php

namespace App\Livewire\Usuarios1;

use App\Models\Usuarios1;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosEstatus;
                use App\Models\UsuariosRoles;

class AddUsuarios1Modal extends Component
{
    use WithFileUploads;
 
    
            public $idcliente;
            
            public $nombre;
            
            public $apellido;
            
            public $cedula;
            
            public $movilpersonal;
            
            public $movilempresa;
            
            public $foto;
            
            public $correo;
            
            public $clave;
            
            public $firma;
            
            public $observaciones;
            
            public $idestatus;
            
            public $admin;
            
            public $idrol;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Usuarios1' => 'deleteUsuarios1',
        'update_Usuarios1' => 'updateUsuarios1',
        'new_Usuarios1' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
                "UsuariosRoles" => UsuariosRoles::all(),
                
        ];

        return view('livewire.Usuarios1.add-Usuarios1-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsuarios1Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idusuario = $data->data->idusuario;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
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
            if(  isset( $this->correo) ){
            $data [ "correo" ] = $this->correo;  
            } 
            if(  isset( $this->clave) ){
            $data [ "clave" ] = $this->clave;  
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
            if(  isset( $this->admin) ){
            $data [ "admin" ] = $this->admin;  
            } 
            if(  isset( $this->idrol) ){
            $data [ "idrol" ] = $this->idrol;  
            }
            
            $Usuarios1 = Usuarios1::where('idusuario', $this->idusuario)->first() ?? Usuarios1::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Usuarios1->$k = $v;
                }
                $Usuarios1->save();
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

    public function deleteUsuarios1($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Usuarios1::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsuarios1($id)
    {
        Log::info('updateUsuarios1');

        $this->edit_mode = true;

        $Usuarios1 = Usuarios1::find($id);

        Log::info($Usuarios1 );

        
            $this->idcliente = $Usuarios1->idcliente;
            
            $this->nombre = $Usuarios1->nombre;
            
            $this->apellido = $Usuarios1->apellido;
            
            $this->cedula = $Usuarios1->cedula;
            
            $this->movilpersonal = $Usuarios1->movilpersonal;
            
            $this->movilempresa = $Usuarios1->movilempresa;
            
            $this->foto = $Usuarios1->foto;
            
            $this->correo = $Usuarios1->correo;
            
            $this->clave = $Usuarios1->clave;
            
            $this->firma = $Usuarios1->firma;
            
            $this->observaciones = $Usuarios1->observaciones;
            
            $this->idestatus = $Usuarios1->idestatus;
            
            $this->admin = $Usuarios1->admin;
            
            $this->idrol = $Usuarios1->idrol;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
