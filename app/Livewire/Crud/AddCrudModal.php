<?php

namespace App\Livewire\Crud;

use App\Models\Crud;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddCrudModal extends Component
{
    use WithFileUploads;

    public $crud_id;
    public $nombre;
    public $alias_opcion;
    public $nombre_componente;

    public $edit_mode = false;

    protected $rules = [
        'nombre' => 'required|string',
    ];

    protected $listeners = [
        'new_crud' => 'hydrate',
    ];

    public function render()
    {
        $cruds_created = []; //Crud::pluck('name')->toArray();
        $cruds_availables = $cruds_filtered =  $cruds_filtered_columns = [];
        $tables = DB::select('SHOW TABLES'); // returns an array of stdObjects  
        $tables_excluded_env = env('CRUD_TABLES_EXCLUDED', 'addresses,cruds,failed_jobs,migrations,model_has_permissions,model_has_roles,password_resets,permissions,personal_access_tokens,role_has_permissions,roles');
        $tables_excluded = explode(',', $tables_excluded_env);

        foreach ($tables as $i => $crud_table) {
            $table_name = $crud_table->Tables_in_pdgsabd;

            if (!in_array($table_name, $tables_excluded)) {
                $cruds_availables[$i] = $crud_table->Tables_in_pdgsabd;
                if (!array_search($table_name, $cruds_created)) {
                    $cruds_filtered[$i] = $crud_table->Tables_in_pdgsabd ?? '';
                    $cruds_filtered_columns[$table_name] = DB::select("SHOW COLUMNS FROM " . $table_name);
                }
            }
        }

        return view('livewire.crud.add-crud-modal', compact('cruds_availables', 'cruds_filtered', 'cruds_filtered_columns'));
    }

    public function submit(Request $request)
    {
        Log::info('AddCrudModal - submit');
        Log::info($request);

        // Validate the form input data
        $this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new user
            $data = [
                'nombre' => $this->nombre,
                'alias_opcion' => $this->alias_opcion,
                'nombre_componente' => $this->nombre_componente,
            ];
            $crud = Crud::where('id', $this->crud_id)->first();

            if (!$crud) {
                $crud = Crud::create($data);
            }

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $crud->$k = $v;
                }
                $crud->save();
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

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
