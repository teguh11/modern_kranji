<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $tables = 'orders';
    //

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}

