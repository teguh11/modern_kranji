<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class TipeUnit extends Model
{
    use HasRoles;
    protected $table = 'tipe_unit';
    //
}
