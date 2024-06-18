<?php

namespace App\Livewire\Contactos4;

use App\Models\Contactos4;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

                use App\Models\ContactosOrigenesdedatos;
                use App\Models\ContactosEstadocivil;
                use App\Models\ContactosProvincias;
                use App\Models\ContactosFormascontacto;
                use App\Models\Users;
                use App\Models\Pasos;

class AddContactos4Modal extends Component
{
    use WithFileUploads;
 
    
                public $idcontacto;
                
                public $nombre;
                
                public $telefono;
                
                public $celular;
                
                public $whatsapp;
                
                public $otrotelefono;
                
                public $correo;
                
                public $idorigendatos;
                
                public $fechanacimiento;
                
                public $idestadocivil;
                
                public $ingresofamiliar;
                
                public $idprovincia;
                
                public $idformacontacto;
                
                public $horario;
                
                public $idvendedor;
                
                public $idpaso;
                

    public $edit_mode = false;

    protected $rules = [
        
    ];

    protected $listeners = [
        'delete_Contactos4' => 'deleteContactos4',
        'update_Contactos4' => 'updateContactos4',
        'new_Contactos4' => 'hydrate',
    ];

    public function render()
    {
        //fk
        $details = [        
        
                "ContactosOrigenesdedatos" => ContactosOrigenesdedatos::all(),
                
                "ContactosEstadocivil" => ContactosEstadocivil::all(),
                
                "ContactosProvincias" => ContactosProvincias::all(),
                
                "ContactosFormascontacto" => ContactosFormascontacto::all(),
                
                "Users" => Users::all(),
                
                "Pasos" => Pasos::all(),
                
        ];

        return view('livewire.Contactos4.add-Contactos4-modal', $details);
    }

    public function submit(Request $request)
    {
        Log::info('AddContactos4Modal - submit');
        Log::info($request);

        $data = json_decode($request['components'][0]['snapshot']);
        //Log::info($data->data);
        $this->idcontacto = $data->data->idcontacto;
        $this->edit_mode = $data->data->edit_mode;

        // Validate the form input data
        //$this->validate();

        DB::transaction(function () {
            // Prepare the data for creating a new 
            $data = [];
                 
            if(  isset( $this->nombre) ){
            $data [ "nombre" ] = $this->nombre;  
            } 
            if(  isset( $this->telefono) ){
            $data [ "telefono" ] = $this->telefono;  
            } 
            if(  isset( $this->celular) ){
            $data [ "celular" ] = $this->celular;  
            } 
            if(  isset( $this->whatsapp) ){
            $data [ "whatsapp" ] = $this->whatsapp;  
            } 
            if(  isset( $this->otrotelefono) ){
            $data [ "otrotelefono" ] = $this->otrotelefono;  
            } 
            if(  isset( $this->correo) ){
            $data [ "correo" ] = $this->correo;  
            } 
            if(  isset( $this->idorigendatos) ){
            $data [ "idorigendatos" ] = $this->idorigendatos;  
            } 
            if(  isset( $this->fechanacimiento) ){
            $data [ "fechanacimiento" ] = $this->fechanacimiento;  
            } 
            if(  isset( $this->idestadocivil) ){
            $data [ "idestadocivil" ] = $this->idestadocivil;  
            } 
            if(  isset( $this->ingresofamiliar) ){
            $data [ "ingresofamiliar" ] = $this->ingresofamiliar;  
            } 
            if(  isset( $this->idprovincia) ){
            $data [ "idprovincia" ] = $this->idprovincia;  
            } 
            if(  isset( $this->idformacontacto) ){
            $data [ "idformacontacto" ] = $this->idformacontacto;  
            } 
            if(  isset( $this->horario) ){
            $data [ "horario" ] = $this->horario;  
            } 
            if(  isset( $this->idvendedor) ){
            $data [ "idvendedor" ] = $this->idvendedor;  
            } 
            if(  isset( $this->idpaso) ){
            $data [ "idpaso" ] = $this->idpaso;  
            }
            
            $Contactos4 = Contactos4::where('idcontacto', $this->idcontacto)->first() ?? Contactos4::create($data);

            if ($this->edit_mode) {
                foreach ($data as $k => $v) {
                    $Contactos4->$k = $v;
                }
                $Contactos4->save();
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

    public function deleteContactos4($id)
    {
        // Prevent deletion 
        if ($id == Auth::id()) {
            $this->dispatch('error', 'No se puede eliminar');
            return;
        }

        // Delete the record with the specified ID
        Contactos4::destroy($id);

        // Emit a success event with a message
        $this->dispatch('success', 'Eliminado correctamente');
    }

    public function updateContactos4($id)
    {
        Log::info('updateContactos4');

        $this->edit_mode = true;

        $Contactos4 = Contactos4::find($id);

        Log::info($Contactos4 );

        
            $this->idcontacto = $Contactos4->idcontacto;
            
            $this->nombre = $Contactos4->nombre;
            
            $this->telefono = $Contactos4->telefono;
            
            $this->celular = $Contactos4->celular;
            
            $this->whatsapp = $Contactos4->whatsapp;
            
            $this->otrotelefono = $Contactos4->otrotelefono;
            
            $this->correo = $Contactos4->correo;
            
            $this->idorigendatos = $Contactos4->idorigendatos;
            
            $this->fechanacimiento = $Contactos4->fechanacimiento;
            
            $this->idestadocivil = $Contactos4->idestadocivil;
            
            $this->ingresofamiliar = $Contactos4->ingresofamiliar;
            
            $this->idprovincia = $Contactos4->idprovincia;
            
            $this->idformacontacto = $Contactos4->idformacontacto;
            
            $this->horario = $Contactos4->horario;
            
            $this->idvendedor = $Contactos4->idvendedor;
            
            $this->idpaso = $Contactos4->idpaso;
            
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset();
    }
}
