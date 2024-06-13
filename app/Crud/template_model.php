<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class %OBJETO% extends Model
{
    use HasFactory;

    protected $table = "%TABLA%";
	
	protected $fillable = [
        %TABLA_CAMPOS%
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = '%FIELD_ID%';

    public $timestamps = false; 

	//relations
    %RELATIONS%
}
