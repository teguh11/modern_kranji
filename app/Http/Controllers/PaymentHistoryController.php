<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Http\Requests\PaymentHistoryRequest;
use App\Orders;
use App\PaymentHistories;
use App\PaymentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PaymentHistoryController extends Controller
{
//     SELECT 
// clients.name as client_name,
// clients.address as client_address,
// clients.handphone as client_phone,
// clients.email as client_email,
// users.name as user_name,
// users.email as user_email,
// unit.unit_name as unit_name,
// unit_types.name as unit_type,
// floors.name as unit_floor,
// views.name as unit_view,
// towers.name as unit_tower,
// payment_histories.payment_number as payment_number,
// payment_histories.nominal as payment,
// payment_histories.payment_method as payment_method,
// payment_histories.payment_date as payment_date,
// payment_status.name as payment_status
// from orders
// LEFT JOIN clients on orders.client_id = clients.id
// LEFT JOIN users on orders.user_id = users.id
// LEFT JOIN unit on orders.unit_id = unit.id
// LEFT join unit_types on unit.unit_type_id = unit_types.id
// LEFT JOIN floors on unit.floor_id = floors.id
// LEFT JOIN `views` on unit.view_id = `views`.id
// LEFT JOIN towers on unit.tower_id = towers.id
// LEFT JOIN payment_histories on orders.id = payment_histories.order_id
// LEFT JOIN payment_status on payment_histories.payment_status_id = payment_status.id
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

    public function index()
    {
        return view('layouts.payment_history.index');
        //
    }

    public function data()
    {
        // dd(\App\PaymentHistories::PAYMENT_METHOD[1]);
        $paymentHistories = DB::table('payment_histories')
            ->select(
                'payment_histories.id',
                'payment_histories.payment_number',
                'payment_histories.nominal',
                'payment_status.name as payment_status',
                'payment_histories.payment_method',
                'payment_histories.payment_date',
                'payment_histories.refundable_status',
                'payment_histories.status'
            )
            ->join('orders', 'payment_histories.order_id', '=', 'orders.id')
            ->join('unit', 'orders.unit_id', '=', 'unit.id')
            ->join('payment_status', 'payment_histories.payment_status_id', '=', 'payment_status.id')
            ->get();
            
        return DataTables::of($paymentHistories)
        ->addColumn('action', function($paymentHistory)
        {
            return '<a href="'.route('payment-history.edit',['id' => $paymentHistory->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->editColumn('nominal', '{{number_format($nominal, "0", ",", ".")}}')
        ->editColumn('payment_method', '{{App\PaymentHistories::PAYMENT_METHOD[$payment_method]}}')
        ->editColumn('status', '{{App\PaymentHistories::STATUS[$status]}}')
        ->editColumn('refundable_status', '{{App\PaymentHistories::REFUNDABLE_STATUS[$refundable_status]}}')
        ->make(true);
        # code...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $payment_history = DB::table('payment_histories')->select('payment_status_id as id')->distinct()->where('order_id', '=', $request->query('order'))->get()->pluck('id');
        
        $payment_status = DB::table('payment_status')->select('id', 'name')->whereNotIn('id', $payment_history->toArray())->get();
        $options = [
            'type' => 'create',
            'order' => DB::table('orders')
                        ->select('orders.id as order_id', 'unit.unit_name as unit_name', 'clients.name as client_name')
                        ->join('unit','orders.unit_id', '=', 'unit.id')
                        ->join('clients','orders.client_id', '=', 'clients.id')
                        ->where('orders.id', '=', $request->query('order'))
                        ->first(),
            'payment_status' => $payment_status,
            'payment_methods' => PaymentHistories::PAYMENT_METHOD,
            'status' => PaymentHistories::STATUS,
            'refundable_status' => PaymentHistories::REFUNDABLE_STATUS
        ];
        return view('layouts.payment_history.formForOrder', $options);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentHistoryRequest $request)
    {
        $request->validated();
        $pr = DB::table("payment_histories")->insert([
            'order_id' => $request->order_id,
            'user_id' => auth()->user()->id,
            'payment_status_id' => $request->payment_status,
            'payment_number' => 'PN_'.$request->order_id."_".auth()->user()->id."_".rand(0, 9999)."_".strtotime(date('YmdHis')),
            'nominal' => str_replace(",","", $request->nominal),
            'payment_method' => $request->payment_method,
            'payment_date' => date('Y-m-d H:i:s'),
            'status' => ($request->payment_status_id == 2 ? 1 : 0),
            'refundable_status' => $request->refundable_status
        ]);

        if($pr){
            return redirect(route('orders.index'));
        }
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
    public function edit(Request $request, $id)
    {
        $payment_history = DB::table('payment_histories')->select('payment_status_id as id')->distinct()->where('order_id', '=', $request->query('order'))->get()->pluck('id');
        $payment_status = DB::table('payment_status')->select('id', 'name')->whereNotIn('id', $payment_history->toArray())->get();
        $options = [
            'type' => 'update',
            'payment_status' => $payment_status,
            'payment_methods' => PaymentHistories::PAYMENT_METHOD,
            'status' => PaymentHistories::STATUS,
            'refundable_status' => PaymentHistories::REFUNDABLE_STATUS,
            'data' => PaymentHistories::where("id", $id)->first()
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
    public function update(PaymentHistoryRequest $request, $id)
    {
        $request->validated();
        DB::table('payment_histories')
        ->where('id', $id)
        ->update([
            'nominal' => str_replace(",","", $request->nominal),
            'payment_method' => $request->payment_method,
            'payment_date' => date('Y-m-d H:i:s'),
            'status' => ($request->payment_status_id == 2 ? 1 : 0),
            'refundable_status' => $request->refundable_status
        ]);
        return redirect(route('payment-history.index'));
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
