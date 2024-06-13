<?php

namespace App\Livewire\CrudsGeneradosMenues100;

use App\Models\CrudsGeneradosMenues100;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\CrudsGenerados;
                use App\Models\Menues;
use App\Services\GeneradorCrudService;

class AddCrudsGeneradosMenues100Modal extends Component
{
    use WithFileUploads;
 
    
            public $idcrudgenmenu;
            
            public $idcrudgen;
            
            public $idmenu;
            
            public $posicion;
            
            public bool $estatus;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_CrudsGeneradosMenues100' => 'deleteCrudsGeneradosMenues100',
        'update_CrudsGeneradosMenues100' => 'updateCrudsGeneradosMenues100',
        'new_CrudsGeneradosMenues100' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "CrudsGenerados" => CrudsGenerados::where('estatus',1)->get(),
                
                "Menues" => Menues::all(),
                
        ];

        return view('livewire.CrudsGeneradosMenues100.add-CrudsGeneradosMenues100-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddCrudsGeneradosMenues100Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idcrudgenmenu = $data->data->idcrudgenmenu;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idcrudgen) ){
            $data [ "idcrudgen" ] = $this->idcrudgen;  
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
            /*  else{
                $data [ "estatus" ] = 0;  
                }
            */
            $CrudsGeneradosMenues100 = CrudsGeneradosMenues100::where('idcrudgenmenu', $this->idcrudgenmenu)->first() ?? CrudsGeneradosMenues100::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $CrudsGeneradosMenues100->$k = $v;
                }
                $CrudsGeneradosMenues100->save();
            }

            if ($this->edit_mode) {
                // Emit a success event with a message
                $this->dispatch('success', __('Actualizado correctamente!'));
            } else {                

                $generadorCrudService = new GeneradorCrudService();

                $generadorCrudService->generateRutaBreadCrumb($CrudsGeneradosMenues100);

                // Emit a success event with a message
                $this->dispatch('success', __('Creado correctamente!'));
            }
        });

        // Reset the form fields after successful submission
        $this->reset();
    }

    public function deleteCrudsGeneradosMenues100($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        CrudsGeneradosMenues100::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateCrudsGeneradosMenues100($id)
    {
        Log::info('updateCrudsGeneradosMenues100');

        $this->edit_mode = true;

        $CrudsGeneradosMenues100 = CrudsGeneradosMenues100::find($id);

        Log::info($CrudsGeneradosMenues100 );

        
            $this->idcrudgenmenu = $CrudsGeneradosMenues100->idcrudgenmenu;
            
            $this->idcrudgen = $CrudsGeneradosMenues100->idcrudgen;
            
            $this->idmenu = $CrudsGeneradosMenues100->idmenu;
            
            $this->posicion = $CrudsGeneradosMenues100->posicion;
            
            $this->estatus = $CrudsGeneradosMenues100->estatus;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
