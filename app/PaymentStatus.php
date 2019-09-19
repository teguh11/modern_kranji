<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStatus extends Model
{
    protected $table = 'payment_status';
    const PAYMENT_STATUS = [2,3,4,5,6];
    //
}
