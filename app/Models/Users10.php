<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users10 extends Model
{
    use HasFactory;

    protected $table = "users";
	
	protected $fillable = [
        'id','name','admin',
    ];	

        /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    public $timestamps = false; 

	//relations
    
}
