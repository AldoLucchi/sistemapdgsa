<?php

namespace App\Livewire\Users10;

use App\Models\Users10;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class AddUsers10Modal extends Component
{
    use WithFileUploads;
 
    
                public $id;
                
                public $name;
                
                public $admin;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Users10' => 'deleteUsers10',
        'update_Users10' => 'updateUsers10',
        'new_Users10' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
        ];

        return view('livewire.Users10.add-Users10-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddUsers10Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->id = $data->data->id;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->name) ){
            $data [ "name" ] = $this->name;  
            } 
            if(  isset( $this->admin) ){
            $data [ "admin" ] = $this->admin;  
            }
            
            $Users10 = Users10::where('id', $this->id)->first() ?? Users10::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Users10->$k = $v;
                }
                $Users10->save();
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

    public function deleteUsers10($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Users10::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateUsers10($id)
    {
        Log::info('updateUsers10');

        $this->edit_mode = true;

        $Users10 = Users10::find($id);

        Log::info($Users10 );

        
            $this->id = $Users10->id;
            
            $this->name = $Users10->name;
            
            $this->admin = $Users10->admin;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
