<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    use HasRoles;
    protected $table = 'pembeli';
}
