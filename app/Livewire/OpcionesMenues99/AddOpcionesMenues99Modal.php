<?php

namespace App\Livewire\OpcionesMenues99;

use App\Models\OpcionesMenues99;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\Opciones;
                use App\Models\Menues;

class AddOpcionesMenues99Modal extends Component
{
    use WithFileUploads;
 
    
            public $idopcionnmenu;
            
            public $idopcion;
            
            public $idmenu;
            
            public $posicion;
            
            public bool $estatus;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_OpcionesMenues99' => 'deleteOpcionesMenues99',
        'update_OpcionesMenues99' => 'updateOpcionesMenues99',
        'new_OpcionesMenues99' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "Opciones" => Opciones::all(),
                
                "Menues" => Menues::all(),
                
        ];

        return view('livewire.OpcionesMenues99.add-OpcionesMenues99-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddOpcionesMenues99Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idopcionnmenu = $data->data->idopcionnmenu;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idopcion) ){
            $data [ "idopcion" ] = $this->idopcion;  
            } 
            if(  isset( $this->idmenu) ){
            $data [ "idmenu" ] = $this->idmenu;  
            } 
            if(  isset( $this->posicion) ){
            $data [ "posicion" ] = $this->posicion;  
            } 
            if(  isset( $this->estatus) ){
            $data [ "estatus" ] = $this->estatus;  
            } 
                /* else{
                $data [ "estatus" ] = 0;  
                }*/
            
            $OpcionesMenues99 = OpcionesMenues99::where('idopcionnmenu', $this->idopcionnmenu)->first() ?? OpcionesMenues99::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $OpcionesMenues99->$k = $v;
                }
                $OpcionesMenues99->save();
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

    public function deleteOpcionesMenues99($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        OpcionesMenues99::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateOpcionesMenues99($id)
    {
        Log::info('updateOpcionesMenues99');

        $this->edit_mode = true;

        $OpcionesMenues99 = OpcionesMenues99::find($id);

        Log::info($OpcionesMenues99 );

        
            $this->idopcionnmenu = $OpcionesMenues99->idopcionnmenu;
            
            $this->idopcion = $OpcionesMenues99->idopcion;
            
            $this->idmenu = $OpcionesMenues99->idmenu;
            
            $this->posicion = $OpcionesMenues99->posicion;
            
            $this->estatus = $OpcionesMenues99->estatus;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
