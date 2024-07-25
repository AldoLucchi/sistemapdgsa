<?php

namespace App\Livewire\Accesosdirectos69;

use App\Models\Accesosdirectos69;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\CrudsGenerados;

class AddAccesosdirectos69Modal extends Component
{
    use WithFileUploads;
 
    
                public $idaccesodirecto;
                
                public $titulo;
                
                public $idtipo;
                
                public $icono;
                
                public $url;
                
                public $idcrud;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Accesosdirectos69' => 'deleteAccesosdirectos69',
        'update_Accesosdirectos69' => 'updateAccesosdirectos69',
        'new_Accesosdirectos69' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "CrudsGenerados" => CrudsGenerados::all(),
                
        ];

        return view('livewire.Accesosdirectos69.add-Accesosdirectos69-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddAccesosdirectos69Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idaccesodirecto = $data->data->idaccesodirecto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->titulo) ){
            $data [ "titulo" ] = $this->titulo;  
            } 
            if(  isset( $this->idtipo) ){
            $data [ "idtipo" ] = $this->idtipo;  
            } 
            if(  isset( $this->icono) ){
            $data [ "icono" ] = $this->icono;  
            } 
            if(  isset( $this->url) ){
            $data [ "url" ] = $this->url;  
            } 
            if(  isset( $this->idcrud) ){
            $data [ "idcrud" ] = $this->idcrud;  
            }
            
            $Accesosdirectos69 = Accesosdirectos69::where('idaccesodirecto', $this->idaccesodirecto)->first() ?? Accesosdirectos69::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Accesosdirectos69->$k = $v;
                }
                $Accesosdirectos69->save();
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

    public function deleteAccesosdirectos69($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Accesosdirectos69::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateAccesosdirectos69($id)
    {
        Log::info('updateAccesosdirectos69');

        $this->edit_mode = true;

        $Accesosdirectos69 = Accesosdirectos69::find($id);

        Log::info($Accesosdirectos69 );

        
            $this->idaccesodirecto = $Accesosdirectos69->idaccesodirecto;
            
            $this->titulo = $Accesosdirectos69->titulo;
            
            $this->idtipo = $Accesosdirectos69->idtipo;
            
            $this->icono = $Accesosdirectos69->icono;
            
            $this->url = $Accesosdirectos69->url;
            
            $this->idcrud = $Accesosdirectos69->idcrud;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
