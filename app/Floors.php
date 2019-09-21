<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class Floors extends Model
{
    protected $table = 'floors';
    const UPDATED_AT = 'update_at';
    //
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
