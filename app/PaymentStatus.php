<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';
    const RESERVED  = [2];
    const BOOKING   = [3];
    const DP        = [3,4];
    const CASH_BERTAHAP = [3,4,5];
    const LUNAS     = [3,4,5,6];

}
