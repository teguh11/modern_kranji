<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class UnitTypes extends Model
{
    protected $table = 'unit_types';
    const UPDATED_AT = 'update_at';
    //
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
