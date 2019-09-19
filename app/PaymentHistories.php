<?php

namespace App;

use App\Scopes\StatusScope;
use Illuminate\Database\Eloquent\Model;

class PaymentHistories extends Model
{
    //
    protected $tables='payment_histories';
    const PAYMENT_METHOD = [
        'Cash',
        'Transfer'
    ];
    const STATUS = [
        'Not Refundable',
        'Refundable'
    ];
    const REFUNDABLE_STATUS = [
        'No',
        'Yes'
    ];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new StatusScope);
    }
}
