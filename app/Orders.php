<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Orders extends Model
{
    use HasRoles;
    protected $tables = 'orders';
    //
}
