<?php

namespace App\Livewire\Proyectos14;

use App\Models\Proyectos14;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\Usuarios;
                use App\Models\UsuariosEstatus;

class AddProyectos14Modal extends Component
{
    use WithFileUploads;
 
    
                public $idproyecto;
                
                public $nombre;
                
                public $idcliente;
                
                public $idusuario;
                
                public $logo;
                
                public $direccion;
                
                public $idestatus;
                
                public $identificadorcontrato;
                
                public $idconstructora;
                
                public $fincamadre;
                
                public $codigoubicacion;
                
                public $codigocrm;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Proyectos14' => 'deleteProyectos14',
        'update_Proyectos14' => 'updateProyectos14',
        'new_Proyectos14' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "Usuarios" => Usuarios::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
        ];

        return view('livewire.Proyectos14.add-Proyectos14-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddProyectos14Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idproyecto = $data->data->idproyecto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->idusuario) ){
            $data [ "idusuario" ] = $this->idusuario;  
            } 
            if(  isset( $this->logo) ){
            $data [ "logo" ] = $this->logo;  
            } 
            if(  isset( $this->direccion) ){
            $data [ "direccion" ] = $this->direccion;  
            } 
            if(  isset( $this->idestatus) ){
            $data [ "idestatus" ] = $this->idestatus;  
            } 
            if(  isset( $this->identificadorcontrato) ){
            $data [ "identificadorcontrato" ] = $this->identificadorcontrato;  
            } 
            if(  isset( $this->idconstructora) ){
            $data [ "idconstructora" ] = $this->idconstructora;  
            } 
            if(  isset( $this->fincamadre) ){
            $data [ "fincamadre" ] = $this->fincamadre;  
            } 
            if(  isset( $this->codigoubicacion) ){
            $data [ "codigoubicacion" ] = $this->codigoubicacion;  
            } 
            if(  isset( $this->codigocrm) ){
            $data [ "codigocrm" ] = $this->codigocrm;  
            }
            
            $Proyectos14 = Proyectos14::where('idproyecto', $this->idproyecto)->first() ?? Proyectos14::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Proyectos14->$k = $v;
                }
                $Proyectos14->save();
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

    public function deleteProyectos14($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Proyectos14::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateProyectos14($id)
    {
        Log::info('updateProyectos14');

        $this->edit_mode = true;

        $Proyectos14 = Proyectos14::find($id);

        Log::info($Proyectos14 );

        
            $this->idproyecto = $Proyectos14->idproyecto;
            
            $this->nombre = $Proyectos14->nombre;
            
            $this->idcliente = $Proyectos14->idcliente;
            
            $this->idusuario = $Proyectos14->idusuario;
            
            $this->logo = $Proyectos14->logo;
            
            $this->direccion = $Proyectos14->direccion;
            
            $this->idestatus = $Proyectos14->idestatus;
            
            $this->identificadorcontrato = $Proyectos14->identificadorcontrato;
            
            $this->idconstructora = $Proyectos14->idconstructora;
            
            $this->fincamadre = $Proyectos14->fincamadre;
            
            $this->codigoubicacion = $Proyectos14->codigoubicacion;
            
            $this->codigocrm = $Proyectos14->codigocrm;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
