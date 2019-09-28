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
    const RESERVED = [2];
    const BOOKING = [2,3];
    const DP = [2,3,4];
    const CASH_BERTAHAP = [2,3,4,5];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope(new StatusScope);
    }
}
