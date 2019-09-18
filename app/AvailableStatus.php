<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class AvailableStatus extends Model
{
    protected $table = 'available_status';
    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }

    //
}
