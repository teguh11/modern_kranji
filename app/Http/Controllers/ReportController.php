<?php

namespace App\Http\Controllers;

use App\Authorizable;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use Authorizable;

    public function unit()
    {
        return "Hello unit";
    }

    public function order()
    {
        return "Hello order";
    }

    public function transaction()
    {
        return "Hello transaction";
    }
}
