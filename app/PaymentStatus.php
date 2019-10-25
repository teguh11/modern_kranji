<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';
    const RESERVED  = [2];
    const BOOKING   = [2,3];
    const DP        = [3,4];
    const CASH_BERTAHAP = [3,4,5];
    const LUNAS     = [3,4,5,6];

    const RESERVED_ID = 2;
    const BOOKING_ID = 3;
    const DP_ID = 4;
    const CASH_BERTAHAP_ID = 5;
    const LUNAS_ID = 6;
    
}
