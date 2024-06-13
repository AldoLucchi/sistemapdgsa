<?php

namespace App\Livewire\%OBJETO%;

use App\Models\%OBJETO%;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
%LIVEWIRE_SELECTS_USE%

class Add%OBJETO%Modal extends Component
{
    use WithFileUploads;
 
    %LIVEWIRE_COLUMNS%

    public $edit_mode = false;

    protected $rules = [
        %LIVEWIRE_RULES%
    ];

    protected $listeners = [
        'delete_%OBJETO_VARIABLE%' => 'delete%OBJETO%',
        'update_%OBJETO_VARIABLE%' => 'update%OBJETO%',
        'new_%OBJETO_VARIABLE%' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        %LIVEWIRE_SELECTS%
        ];

        return view('livewire.%OBJETO_VIEW%.add-%OBJETO_VIEW%-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('Add%OBJETO%Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->%FIELD_ID% = $data->data->%FIELD_ID%;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                %LIVEWIRE_DATA%
            
            $%OBJETO_VARIABLE% = %OBJETO%::where('%FIELD_ID%', $this->%FIELD_ID%)->first() ?? %OBJETO%::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $%OBJETO_VARIABLE%->$k = $v;
                }
                $%OBJETO_VARIABLE%->save();
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

    public function delete%OBJETO%($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        %OBJETO%::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function update%OBJETO%($id)
    {
        Log::info('update%OBJETO%');

        $this->edit_mode = true;

        $%OBJETO_VARIABLE% = %OBJETO%::find($id);

        Log::info($%OBJETO_VARIABLE% );

        %LIVEWIRE_FIELDS%
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
