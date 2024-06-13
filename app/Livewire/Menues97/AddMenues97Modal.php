<?php

namespace App\Livewire\Menues97;

use App\Models\Menues97;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddMenues97Modal extends Component
{
    use WithFileUploads;
 
    
            public $idmenu;
            
            public $menu;
            
            public bool $estatus;
            
            public $ruta;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Menues97' => 'deleteMenues97',
        'update_Menues97' => 'updateMenues97',
        'new_Menues97' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Menues97.add-Menues97-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddMenues97Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idmenu = $data->data->idmenu;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->menu) ){
            $data [ "menu" ] = $this->menu;  
            } 
            if(  isset( $this->estatus) ){
            $data [ "estatus" ] = $this->estatus;  
            } 
                /*else{
                $data [ "estatus" ] = 0;  
                } */
            if(  isset( $this->ruta) ){
            $data [ "ruta" ] = $this->ruta;  
            }
            
            $Menues97 = Menues97::where('idmenu', $this->idmenu)->first() ?? Menues97::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Menues97->$k = $v;
                }
                $Menues97->save();
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

    public function deleteMenues97($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Menues97::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateMenues97($id)
    {
        Log::info('updateMenues97');

        $this->edit_mode = true;

        $Menues97 = Menues97::find($id);

        Log::info($Menues97 );

        
            $this->idmenu = $Menues97->idmenu;
            
            $this->menu = $Menues97->menu;
            
            $this->estatus = $Menues97->estatus;
            
            $this->ruta = $Menues97->ruta;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
