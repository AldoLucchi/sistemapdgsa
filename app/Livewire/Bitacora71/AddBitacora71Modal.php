<?php

namespace App\Livewire\Bitacora71;

use App\Models\Bitacora71;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\CrudsGenerados;
                use App\Models\BitacorasAcciones;
                use App\Models\Proyectos;
                use App\Models\Clientes;

class AddBitacora71Modal extends Component
{
    use WithFileUploads;
 
    
                public $idbitacora;
                
                public $idcrud;
                
                public $tabla;
                
                public $id;
                
                public $campoid;
                
                public $idaccion;
                
                public $descripcion;
                
                public $idproyecto;
                
                public $idcliente;
                
                public $ip;
                
                public $fecha;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Bitacora71' => 'deleteBitacora71',
        'update_Bitacora71' => 'updateBitacora71',
        'new_Bitacora71' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "CrudsGenerados" => CrudsGenerados::all(),
                
                "BitacorasAcciones" => BitacorasAcciones::all(),
                
                "Proyectos" => Proyectos::all(),
                
                "Clientes" => Clientes::all(),
                
        ];

        return view('livewire.Bitacora71.add-Bitacora71-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddBitacora71Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idbitacora = $data->data->idbitacora;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idcrud) ){
            $data [ "idcrud" ] = $this->idcrud;  
            } 
            if(  isset( $this->tabla) ){
            $data [ "tabla" ] = $this->tabla;  
            } 
            if(  isset( $this->id) ){
            $data [ "id" ] = $this->id;  
            } 
            if(  isset( $this->campoid) ){
            $data [ "campoid" ] = $this->campoid;  
            } 
            if(  isset( $this->idaccion) ){
            $data [ "idaccion" ] = $this->idaccion;  
            } 
            if(  isset( $this->descripcion) ){
            $data [ "descripcion" ] = $this->descripcion;  
            } 
            if(  isset( $this->idproyecto) ){
            $data [ "idproyecto" ] = $this->idproyecto;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->ip) ){
            $data [ "ip" ] = $this->ip;  
            } 
            if(  isset( $this->fecha) ){
            $data [ "fecha" ] = $this->fecha;  
            }
            
            $Bitacora71 = Bitacora71::where('idbitacora', $this->idbitacora)->first() ?? Bitacora71::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Bitacora71->$k = $v;
                }
                $Bitacora71->save();
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

    public function deleteBitacora71($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Bitacora71::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateBitacora71($id)
    {
        Log::info('updateBitacora71');

        $this->edit_mode = true;

        $Bitacora71 = Bitacora71::find($id);

        Log::info($Bitacora71 );

        
            $this->idbitacora = $Bitacora71->idbitacora;
            
            $this->idcrud = $Bitacora71->idcrud;
            
            $this->tabla = $Bitacora71->tabla;
            
            $this->id = $Bitacora71->id;
            
            $this->campoid = $Bitacora71->campoid;
            
            $this->idaccion = $Bitacora71->idaccion;
            
            $this->descripcion = $Bitacora71->descripcion;
            
            $this->idproyecto = $Bitacora71->idproyecto;
            
            $this->idcliente = $Bitacora71->idcliente;
            
            $this->ip = $Bitacora71->ip;
            
            $this->fecha = $Bitacora71->fecha;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
