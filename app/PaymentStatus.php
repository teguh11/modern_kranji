<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';
    const RESERVED  = [2];
    const BOOKING   = [2,3];
    const DP        = [2,3,4];
    const CASH_BERTAHAP = [2,3,4,5];
    const LUNAS     = [2,3,4,5,6];

}
