<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class UnitTypes extends Model
{
    use HasRoles;
    protected $table = 'unit_types';
    //
}