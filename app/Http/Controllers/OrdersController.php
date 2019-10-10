<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\AvailableStatus;
use App\Clients;
use App\Http\Requests\OrderRequest;
use App\Orders;
use App\PaymentHistories;
use App\PaymentStatus;
use App\Traits\ViewDataByLogin;
use App\Units;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
    use Authorizable;
    use ViewDataByLogin;

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
        return view('layouts.orders.index');
        //
    }
    /**
     * Display data list of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function data()
    {
        $orders = DB::table('orders')
            ->select([
                'orders.id as id', 'orders.order_number', 'clients.name as client_name', 'users.name as user_name', 'unit.id as unit_id', 'unit.unit_name as unit_name', 
                'unit.large as large', 'unit.price as price', 'unit_types.name as unit_type', 'floors.name as floor', 'available_status.name as status',
                DB::raw('(SELECT COUNT(id) FROM payment_histories WHERE payment_histories.order_id = orders.id and valid_transaction=0) As pending_payment')
            
            ])
            ->leftJoin('clients', 'orders.client_id', '=', 'clients.id')
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('unit', 'orders.unit_id', '=', 'unit.id')
            ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
            ->join('floors', 'unit.floor_id', '=', 'floors.id')
            ->leftJoin('available_status', 'unit.available_status_id', '=', 'available_status.id');
            
            if(auth()->user()->hasRole('sales')){
                $orders = $orders->whereNull('unit.available_status_id')
                ->orWhere('orders.user_id', '=', auth()->user()->id);
            }
            $orders = $orders->get();

        return DataTables::of($orders)->addColumn('action', function($order)
        {
            return '<a href="'.route('units.show',['unit' => $order->unit_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> History</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
        ->editColumn('pending_payment', function($order){
            // return $order->pending_payment > 0 ? "<span>".$order->pending_payment."</span>":"";
            return $order->pending_payment > 0 ? '<span class="label label-danger">'.$order->pending_payment.'</span>' : '<span class="label label-success">'.$order->pending_payment.'</span>';
        })
        ->rawColumns(['action', 'pending_payment'])
        ->make(true);
    }

    public function status($status)
    {
        return view('layouts.orders.indexByStatus');
    }

    public function dataByStatus(Request $request)
    {
        $orderId = $this->getOrderByStatus($request->status);
        // dd($orderId);
        if(!empty($orderId)){
            $orders = DB::table('orders')
            ->select('orders.id as id', 'orders.order_number', 'clients.name as client_name', 'users.name as user_name', 'unit.id as unit_id', 'unit.unit_name as unit_name', 
            'unit.large as large', 'unit.price as price', 'unit_types.name as unit_type', 'floors.name as floor', 'available_status.name as status',
            DB::raw('(SELECT COUNT(id) FROM payment_histories WHERE payment_histories.order_id = orders.id and valid_transaction=0) As pending_payment')
            )
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('unit', 'orders.unit_id', '=', 'unit.id')
            ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
            ->join('floors', 'unit.floor_id', '=', 'floors.id')
            ->leftJoin('available_status', 'unit.available_status_id', '=', 'available_status.id')
            ->whereIn('orders.id', $orderId);

            if(auth()->user()->hasRole('sales')){
                $orders->where(function($query){
                    $query->whereNull('unit.available_status_id')
                    ->orWhere('orders.user_id', '=', auth()->user()->id);
                });
            }
            $orders = $orders->get();
        }else{
            $orders = [];
        }
    
        // $orders = $this->viewData($orders, 'orders.user_id');
        
        return DataTables::of($orders)->addColumn('action', function($order)
        {
            return '<a href="'.route('units.show',['unit' => $order->unit_id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> History</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
        ->editColumn('pending_payment', function($order){
            // return $order->pending_payment > 0 ? "<span>".$order->pending_payment."</span>":"";
            return $order->pending_payment > 0 ? '<span class="label label-danger">'.$order->pending_payment.'</span>' : '<span class="label label-success">'.$order->pending_payment.'</span>';
        })
        ->rawColumns(['action', 'pending_payment'])
        ->make(true);
    }

    // will return array order id by status
    // list status : reserved, booking, dp, cash-bertahap
    public function getOrderByStatus($status = '')
    {
        $arr_data = [];
        switch ($status) {
            case 'reserved':
                $arr_data = PaymentStatus::RESERVED;
                break;
            case 'booking':
                $arr_data = PaymentStatus::BOOKING;
                break;
            case 'dp':
                $arr_data = PaymentStatus::DP;
                break;
            case 'cash-bertahap':
                $arr_data = PaymentStatus::CASH_BERTAHAP;
                break;
            default:
                break;
        }
        $having = [];
        foreach($arr_data as $id){
            array_push($having, "SUM(payment_status_id = $id)");
        }
        array_push($having, "NOT SUM(payment_status_id NOT IN (".join(",", $arr_data)."))");
        $having = join(" AND ", $having);
        // dd($having);
        $orderId = DB::table('payment_histories')->select('order_id')
            ->groupBy(['order_id'])
            ->havingRaw($having)
            ->get()->pluck('order_id')->toArray();
        
        return $orderId;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $unit_id = $request->query('unit');
        $detailUnit = $unit = DB::table('unit')
        ->select([
            'unit.unit_number', 
            'unit.unit_name', 
            'unit.large as large', 
            'unit.available_status_id as available_status_id', 
            'unit_types.name as unit_type_name', 
            'floors.name as floor', 
            'unit.price as price', 
            'views.name as view_name', 
            'towers.name as tower_name',
            'clients.id as client_id',
            'clients.name as client_name',
            'clients.handphone as client_phone',
            'clients.address as client_address',
            'users.name as user_name',
            'users.email as user_email',
            'orders.order_number as order_number',
            'orders.created_at as order_date',
            'orders.id as order_id',
            'orders.notes as order_notes',
            'orders.persen_dp as order_persen_dp',
            'orders.nominal_dp as order_nominal_dp',
            'orders.cicilan as order_cicilan',
            'orders.bunga as order_bunga',
            // 'payment_histories.payment_status_id as payment_status',
            // 'payment_histories.payment_method as payment_method',
            // 'payment_histories.nominal as nominal',
            // 'payment_histories.id as payment_history_id',
            // 'payment_histories.valid_transaction as valid_transaction'
        ])
        ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
        ->join('floors', 'unit.floor_id', '=', 'floors.id')
        ->join('views', 'unit.view_id', '=', 'views.id')
        ->join('towers', 'unit.tower_id', '=', 'towers.id')
        ->leftJoin('orders', 'unit.id', '=', 'orders.unit_id')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('clients', 'orders.client_id', '=', 'clients.id')
        ->leftJoin('payment_histories', 'orders.id', '=', 'payment_histories.order_id')
        ->where("unit.id", "=", $unit_id)
        ->first();
        if(auth()->user()->hasRole('kasir')){
            $clients = DB::table('clients')->get();
        }else{
            $clients = DB::table('clients')->where('user_id', "=" , auth()->user()->id)->get();
        }

        if(auth()->user()->hasRole('kasir')){
            $reserved_payment_status = ($unit->available_status_id == null) ? PaymentStatus::BOOKING : array_values(array_diff(PaymentStatus::LUNAS, PaymentStatus::BOOKING)); 
        }else{
            $reserved_payment_status = ($unit->available_status_id == null) ? PaymentStatus::BOOKING : array_values(array_diff(PaymentStatus::DP, PaymentStatus::BOOKING)); 
        }
        // dd($detailUnit);

        $x = DB::table('payment_histories')->select('payment_status_id')->distinct()
        ->join('orders', 'payment_histories.order_id', '=', 'orders.id')
        ->where('unit_id','=', $request->query('unit'))
        ->whereNotIn('payment_status_id', [4,5])->get();

        $y = collect($reserved_payment_status);
        $diff = $y->diff($x->pluck('payment_status_id')->values());
        $payment_status_id = $diff->values()->all();

        $transactionHistory = DB::table('payment_histories')
                ->select([
                    'payment_histories.id',
                    'payment_histories.order_id',
                    'payment_histories.payment_number',
                    'payment_histories.nominal',
                    'payment_histories.payment_date',
                    'payment_histories.refundable_status',
                    'payment_histories.valid_transaction',
                    'payment_histories.payment_method',
                    'users.name as user_name',
                    'payment_status.name as payment_status_name'
                ])
                ->join('payment_status', 'payment_histories.payment_status_id', '=', 'payment_status.id')
                ->join('users', 'payment_histories.user_id', '=', 'users.id')
                ->where('payment_histories.order_id', '=', $unit->order_id)
                ->paginate(10);

        $options = [
            'type' => 'create',
            'unit' => $detailUnit,
            'clients' => $clients,
            'payment_statuss' => PaymentStatus::find($payment_status_id),
            'payment_methods' => PaymentHistories::PAYMENT_METHOD,
            'transactionHistory' => $transactionHistory 
        ];
        // dd($transactionHistory);
        return view('layouts.orders.form', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $request->validated();
        // dd($request);
        $file = "";
        if($request->hasFile('transaction_file')){
            $file = $request->file('transaction_file')->store(env("TRANSACTION_DIR").date("Y/m/d"));
        }

        //insert to tabel order
        DB::transaction(function() use ($request, $file)
        {
            $findOrder = DB::table('orders')->where('unit_id', '=', $request->unit_id)->first();
            if($findOrder == null){
                $orderID = DB::table('orders')->insertGetId([
                    'order_number' => "ORDER_".rand(1, 1000),
                    'client_id' => $request->client,
                    'user_id' => auth()->user()->id,
                    'unit_id' => $request->unit_id,
                    'notes' => $request->notes
                ]);
            }else{
                $orderID = $findOrder->id;

                $detailUnit = DB::table('unit')
                ->join('orders', 'unit.id', '=', 'orders.unit_id')
                ->where('unit.id', $request->unit_id)->whereNull('orders.persen_dp')->first();
                if($detailUnit != null){
                    $dp = (int)str_replace(",","", $request->order_persen_dp);
                    $nominal_dp = ($dp/100) * $detailUnit->price;
                   
                    DB::table('orders')
                    ->where('id', $orderID)
                    ->update([
                        'persen_dp' => $dp,
                        'nominal_dp' => $nominal_dp
                    ]);
                }
            }

            $paymentHistories = [
                'order_id' => $orderID,
                'user_id' => auth()->user()->id,
                'payment_status_id' => $request->payment_status,
                'payment_number' => 'PN_'.$request->order_id."_".auth()->user()->id."_".rand(0, 9999)."_".strtotime(date('YmdHis')),
                'nominal' => str_replace(",","", $request->nominal),
                'payment_method' => $request->payment_method,
                'payment_date' => date('Y-m-d H:i:s'),
                'status' => ($request->payment_status_id == 2 ? 1 : 0),
                'transaction_file' => $file
                // 'refundable_status' => $request->refundable_status
            ];
            if(auth()->user()->hasRole('kasir')){
                $paymentHistories = array_merge($paymentHistories, ['valid_transaction'=>$request->valid_transaction]);
            }
            $pr = DB::table("payment_histories")->insert($paymentHistories);
        });
        return redirect(route('units.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $order_id = $id;
        $unit_id = $request->query('unit');
        $payment_history_id = $request->query('payment_history');
        $detailUnit = $unit = DB::table('unit')
        ->select([
            'unit.unit_number', 
            'unit.unit_name', 
            'unit.large as large', 
            'unit.id as unit_id', 
            'unit.available_status_id',
            'unit_types.name as unit_type_name', 
            'floors.name as floor', 
            'unit.price as price', 
            'views.name as view_name', 
            'towers.name as tower_name',
            'clients.id as client_id',
            'clients.name as client_name',
            'clients.handphone as client_phone',
            'clients.address as client_address',
            'payment_histories.payment_status_id as payment_status',
            'payment_histories.payment_method as payment_method',
            'payment_histories.nominal as nominal',
            'payment_histories.id as payment_history_id',
            'payment_histories.valid_transaction as valid_transaction',
            'users.name as user_name',
            'users.email as user_email',
            'orders.order_number as order_number',
            'orders.created_at as order_date',
            'orders.id as order_id',
            'orders.notes as order_notes',
            'orders.persen_dp as order_persen_dp',
            'orders.nominal_dp as order_nominal_dp',
            'orders.cicilan as order_cicilan',
            'orders.bunga as order_bunga'
        ])
        ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
        ->join('floors', 'unit.floor_id', '=', 'floors.id')
        ->join('views', 'unit.view_id', '=', 'views.id')
        ->join('towers', 'unit.tower_id', '=', 'towers.id')
        ->leftJoin('orders', 'unit.id', '=', 'orders.unit_id')
        ->leftJoin('clients', 'orders.client_id', '=', 'clients.id')
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('payment_histories', 'orders.id', '=', 'payment_histories.order_id')
        ->where("unit.id", "=", $unit_id)
        ->where("orders.id", "=", $order_id)
        ->where("payment_histories.id", "=", $payment_history_id)
        ->first();

        if(auth()->user()->hasRole('kasir')){
            $clients = DB::table('clients')->get();
        }else{
            $clients = DB::table('clients')->where('user_id', "=" , auth()->user()->id)->get();
        }

        $transactionHistory = DB::table('payment_histories')
                ->select([
                    'payment_histories.id',
                    'payment_histories.order_id',
                    'payment_histories.payment_number',
                    'payment_histories.nominal',
                    'payment_histories.payment_date',
                    'payment_histories.refundable_status',
                    'payment_histories.valid_transaction',
                    'payment_histories.payment_method',
                    'users.name as user_name',
                    'payment_status.name as payment_status_name'
                ])
                ->join('payment_status', 'payment_histories.payment_status_id', '=', 'payment_status.id')
                ->join('users', 'payment_histories.user_id', '=', 'users.id')
                ->where('payment_histories.order_id', '=', $unit->order_id)
                ->paginate(10);
        $options = [
            'type' => 'update',
            'unit' => $detailUnit,
            'clients' => $clients,
            'payment_statuss' => PaymentStatus::all(),
            'payment_methods' => PaymentHistories::PAYMENT_METHOD,
            'transactionHistory' => $transactionHistory 
        ];

        return view('layouts.orders.form', $options);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [];

        if($request->valid_transaction == 1){
            $rules = array_merge($rules, ['transaction_file' => 'required']);
        }
        $request->validate($rules);
        

        DB::transaction(function() use ($request){
            $file = "";
            if($request->hasFile('transaction_file')){
                $file = $request->file('transaction_file')->store(env("TRANSACTION_DIR").date("Y/m/d"));
                $file = str_replace("public/", "", $file);
            }

            DB::table('payment_histories')
            ->where('id', $request->query('payment_history'))
            ->update([
                'nominal' => str_replace(",","", $request->nominal),
                'transaction_file' => $file,
                'verified_by' => auth()->user()->id,
                'valid_transaction' => $request->valid_transaction
            ]);

            $ph = PaymentHistories::where('id', $request->query('payment_history'))->where('valid_transaction', 1)->first();

            // ubah status unit jika transaksi yang terjadi sudah valid
            if($ph != null){
                if(in_array($ph->payment_status_id, AvailableStatus::RESERVED)){
                    $available_status = 1;
                }elseif (in_array($ph->payment_status_id, AvailableStatus::BOOKED)) {
                    $available_status = 2;
                }elseif (in_array($ph->payment_status_id, AvailableStatus::SOLD_OUT)) {
                    $available_status = 3;
                }else{
                    $available_status = 0;
                }
    
                DB::table('unit')->where('id', $request->query('unit'))->update(['available_status_id' => $available_status]);
            }
       });
        
        return redirect(route('units.show',['unit' => $request->query('unit')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
