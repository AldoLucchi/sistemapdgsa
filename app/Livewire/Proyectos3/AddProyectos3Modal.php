<?php

namespace App\Livewire\Proyectos3;

use App\Models\Proyectos3;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Clientes;
                use App\Models\UsuariosEstatus;

class AddProyectos3Modal extends Component
{
    use WithFileUploads;
 
    
            public $idcliente;
            
            public $nombre;
            
            public $logo;
            
            public $direccion;
            
            public $idestatus;
            
            public $identificadorcontrato;
            
            public $fincamadre;
            
            public $codigoubicacion;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Proyectos3' => 'deleteProyectos3',
        'update_Proyectos3' => 'updateProyectos3',
        'new_Proyectos3' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Clientes" => Clientes::all(),
                
                "UsuariosEstatus" => UsuariosEstatus::all(),
                
        ];

        return view('livewire.Proyectos3.add-Proyectos3-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddProyectos3Modal - submit');
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
                 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
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
            if(  isset( $this->fincamadre) ){
            $data [ "fincamadre" ] = $this->fincamadre;  
            } 
            if(  isset( $this->codigoubicacion) ){
            $data [ "codigoubicacion" ] = $this->codigoubicacion;  
            }
            
            $Proyectos3 = Proyectos3::where('idproyecto', $this->idproyecto)->first() ?? Proyectos3::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Proyectos3->$k = $v;
                }
                $Proyectos3->save();
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

    public function deleteProyectos3($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Proyectos3::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateProyectos3($id)
    {
        Log::info('updateProyectos3');

        $this->edit_mode = true;

        $Proyectos3 = Proyectos3::find($id);

        Log::info($Proyectos3 );

        
            $this->idcliente = $Proyectos3->idcliente;
            
            $this->nombre = $Proyectos3->nombre;
            
            $this->logo = $Proyectos3->logo;
            
            $this->direccion = $Proyectos3->direccion;
            
            $this->idestatus = $Proyectos3->idestatus;
            
            $this->identificadorcontrato = $Proyectos3->identificadorcontrato;
            
            $this->fincamadre = $Proyectos3->fincamadre;
            
            $this->codigoubicacion = $Proyectos3->codigoubicacion;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
