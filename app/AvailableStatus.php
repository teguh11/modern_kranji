<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class AvailableStatus extends Model
{
    protected $table = 'available_status';

    // status 2,3,4,5,6 diambil dari table payment histories
    const RESERVED = [2,3];
    const BOOKED = [4,5];
    const SOLD_OUT  = [6];    
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }

    //
}
