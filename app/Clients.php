<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasRoles;
    protected $table = 'clients';
}