<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'role_id', 'model_type', 'model_id',
    ];
   
    //
}
