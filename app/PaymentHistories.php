<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class PaymentHistories extends Model
{
    //
    protected $tables='payment_histories';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new StatusScope);
    }
}
