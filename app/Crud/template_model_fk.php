<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class %OBJETO_FK% extends Model
{
    use HasFactory;

    protected $table = "%TABLA_FK%";
	
	protected $fillable = [
        %TABLA_CAMPOS_FK%
    ];	

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = '%FIELD_ID_FK%';

    public $timestamps = false; 

		
}
