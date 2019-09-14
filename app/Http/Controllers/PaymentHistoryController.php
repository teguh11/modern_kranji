<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Orders;
use App\PaymentHistories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentHistoryController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const PAYMENT_METHOD_CASH = 0;
    const PAYMENT_METHOD_CASH_NAME = "CASH";
    const PAYMENT_METHOD_TRANSFER = 1;
    const PAYMENT_METHOD_TRANSFER_NAME = "TRANSFER";

    const STATUS_NOT_REFUNDABLE = 0;
    const STATUS_NOT_REFUNDABLE_NAME = "NOT REFUNDABLE";
    const STATUS_REFUNDABLE = 1;
    const STATUS_REFUNDABLE_NAME = "REFUNDABLE";


    public function index()
    {
        return view('layouts.payment_history.index');
        //
    }

    public function data()
    {
        $paymentHistories = DB::table('payment_histories')
        ->select(
            'payment_histories.id',
            'payment_histories.payment_number',
            'payment_histories.nominal',
            'payments.name as payment_name',
            'payment_histories.payment_method',
            'payment_histories.payment_date',
            'payment_histories.refundable_status',
            'payment_histories.status'
        )
        ->join('orders', 'payment_histories.order_id', '=', 'orders.id')
        ->join('unit', 'orders.unit_id', '=', 'unit.id')
        ->join('payments', 'payment_histories.payment_id', '=', 'payments.id')
        ->get();
        return DataTables::of($paymentHistories)
        ->addColumn('action', function($paymentHistory)
        {
            return '<a href="'.route('payment-history.edit',['id' => $paymentHistory->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
        ->make(true);
        # code...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $options = [
            'type' => 'create',
            'orders' => Orders::all()
        ];
        return view('layouts.payment_history.form', $options);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PaymentHistories  $paymentHistories
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentHistories $paymentHistories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PaymentHistories  $paymentHistories
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentHistories $paymentHistories)
    {
        $options = [
            'type' => 'update',
            'orders' => Orders::all()
        ];
        return view('layouts.payment_history.form', $options);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PaymentHistories  $paymentHistories
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentHistories $paymentHistories)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PaymentHistories  $paymentHistories
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentHistories $paymentHistories)
    {
        //
    }
}
