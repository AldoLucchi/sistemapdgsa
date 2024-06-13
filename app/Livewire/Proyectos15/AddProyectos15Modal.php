<?php

namespace App\Livewire\Proyectos15;

use App\Models\Proyectos15;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddProyectos15Modal extends Component
{
    use WithFileUploads;
 
    
                public $idproyecto;
                
                public $nombre;
                
                public $idcliente;
                
                public $logo;
                
                public $direccion;
                
                public $idestatus;
                
                public $identificadorcontrato;
                
                public $codigoubicacion;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Proyectos15' => 'deleteProyectos15',
        'update_Proyectos15' => 'updateProyectos15',
        'new_Proyectos15' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Proyectos15.add-Proyectos15-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddProyectos15Modal - submit');
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
            if(  isset( $this->codigoubicacion) ){
            $data [ "codigoubicacion" ] = $this->codigoubicacion;  
            }
            
            $Proyectos15 = Proyectos15::where('idproyecto', $this->idproyecto)->first() ?? Proyectos15::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Proyectos15->$k = $v;
                }
                $Proyectos15->save();
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

    public function deleteProyectos15($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Proyectos15::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateProyectos15($id)
    {
        Log::info('updateProyectos15');

        $this->edit_mode = true;

        $Proyectos15 = Proyectos15::find($id);

        Log::info($Proyectos15 );

        
            $this->idproyecto = $Proyectos15->idproyecto;
            
            $this->nombre = $Proyectos15->nombre;
            
            $this->idcliente = $Proyectos15->idcliente;
            
            $this->logo = $Proyectos15->logo;
            
            $this->direccion = $Proyectos15->direccion;
            
            $this->idestatus = $Proyectos15->idestatus;
            
            $this->identificadorcontrato = $Proyectos15->identificadorcontrato;
            
            $this->codigoubicacion = $Proyectos15->codigoubicacion;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
