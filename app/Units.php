<?php

namespace App;

use App\Scopes\StatusScope;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Units extends Model
{
    use HasRoles;
    protected $table = 'unit';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
