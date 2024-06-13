<?php

namespace App\Livewire\UsuariosProyectos2;

use App\Models\UsuariosProyectos2;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddUsuariosProyectos2Modal extends Component
{
    use WithFileUploads;
 
    
            public $idusuarioproyecto;
            
            public $idusuario;
            
            public $idproyecto;
            
            public $idcliente;
            
            public $fechac;
            

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_UsuariosProyectos2' => 'deleteUsuariosProyectos2',
        'update_UsuariosProyectos2' => 'updateUsuariosProyectos2',
        'new_UsuariosProyectos2' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.UsuariosProyectos2.add-UsuariosProyectos2-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsuariosProyectos2Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idusuarioproyecto = $data->data->idusuarioproyecto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->idusuario) ){
            $data [ "idusuario" ] = $this->idusuario;  
            } 
            if(  isset( $this->idproyecto) ){
            $data [ "idproyecto" ] = $this->idproyecto;  
            } 
            if(  isset( $this->idcliente) ){
            $data [ "idcliente" ] = $this->idcliente;  
            } 
            if(  isset( $this->fechac) ){
            $data [ "fechac" ] = $this->fechac;  
            }
            
            $UsuariosProyectos2 = UsuariosProyectos2::where('idusuarioproyecto', $this->idusuarioproyecto)->first() ?? UsuariosProyectos2::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $UsuariosProyectos2->$k = $v;
                }
                $UsuariosProyectos2->save();
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

    public function deleteUsuariosProyectos2($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        UsuariosProyectos2::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsuariosProyectos2($id)
    {
        Log::info('updateUsuariosProyectos2');

        $this->edit_mode = true;

        $UsuariosProyectos2 = UsuariosProyectos2::find($id);

        Log::info($UsuariosProyectos2 );

        
            $this->idusuarioproyecto = $UsuariosProyectos2->idusuarioproyecto;
            
            $this->idusuario = $UsuariosProyectos2->idusuario;
            
            $this->idproyecto = $UsuariosProyectos2->idproyecto;
            
            $this->idcliente = $UsuariosProyectos2->idcliente;
            
            $this->fechac = $UsuariosProyectos2->fechac;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
