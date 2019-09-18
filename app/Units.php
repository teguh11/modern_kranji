<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    protected $table = 'unit';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
