<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\AvailableStatus;
use App\Clients;
use App\Orders;
use App\Pembeli;
use App\Traits\ViewDataByLogin;
use App\Units;
use App\UnitTypes;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            ->select('orders.id as id', 'orders.order_number', 'clients.name as client_name', 'users.name as user_name', 'unit.unit_name as unit_name', 
            'unit.large as large', 'unit.price as price', 'unit_types.name as unit_type', 'floors.name as floor', 'available_status.name as status')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('unit', 'orders.unit_id', '=', 'unit.id')
            ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
            ->join('floors', 'unit.floor_id', '=', 'floors.id')
            ->join('available_status', 'orders.available_status_id', '=', 'available_status.id');
            $orders = $this->viewData($orders, 'orders.user_id');
            $orders = $orders->get();
        return DataTables::of($orders)->addColumn('action', function($order)
        {
            return 
            '<a href="'.route('orders.edit',['order' => $order->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
             <a href="'.route('payment-history.create',['order' => $order->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Bayar</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
        ->make(true);
        //
    }

    public function status($status)
    {
        return view('layouts.orders.indexByStatus');
    }

    public function dataByStatus(Request $request)
    {
        $orderId = $this->getOrderByStatus($request->status);

        $orders = DB::table('orders')
            ->select('orders.id as id', 'orders.order_number', 'clients.name as client_name', 'users.name as user_name', 'unit.unit_name as unit_name', 
            'unit.large as large', 'unit.price as price', 'unit_types.name as unit_type', 'floors.name as floor', 'available_status.name as status')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('unit', 'orders.unit_id', '=', 'unit.id')
            ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
            ->join('floors', 'unit.floor_id', '=', 'floors.id')
            ->join('available_status', 'orders.available_status_id', '=', 'available_status.id')
            ->whereIn('orders.id', $orderId);

        $orders = $this->viewData($orders, 'orders.user_id');
        $orders = $orders->get();
        
        return DataTables::of($orders)->addColumn('action', function($order)
        {
            return 
            '<a href="'.route('orders.edit',['order' => $order->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
             <a href="'.route('payment-history.create',['order' => $order->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Bayar</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ",", ".")}}')
        ->make(true);
    }

    // will return array order id by status
    // list status : reserved, booking, dp, cash-bertahap
    public function getOrderByStatus($status = '')
    {
        $arr_data = [];
        switch ($status) {
            case 'reserved':
                $arr_data = [2];
                break;
            case 'booking':
                $arr_data = [2, 3];
                break;
            case 'dp':
                $arr_data = [2, 3, 5];
                break;
            case 'cash-bertahap':
                $arr_data = [2, 3, 5, 4];
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
    public function create()
    {
        $options = [
            'type' => 'create',
            'units' => Units::all(),
            'clients' => Clients::all(),
            'users' => User::all(),
            'units' => Units::all(),
            'available_statuss' => AvailableStatus::all(),
        ];

        return view('layouts.orders.form', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('orders')->insert([
            'order_number' => rand(1, 1000),
            'client_id' => $request->client,
            'user_id' => $request->user,
            'unit_id' => $request->unit,
            'available_status_id' => $request->available_status,
        ]);
        return redirect(route('orders.index'));
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
        $canEdit = $this->canEdit($id);
        if($canEdit->count() == 0){
            $options = [
                'type' => 'update',
                'units' => Units::all(),
                'clients' => Clients::all(),
                'users' => User::all(),
                'units' => Units::all(),
                'available_statuss' => AvailableStatus::all(),
                'data' => Orders::where("id", $id)->first()
            ];
            return view('layouts.orders.form', $options);
        }else{
            return view('themes.adminlte.error500');
        }
    }

    public function canEdit($orderId)
    {
        $result = DB::table('orders')->select('orders.id')
        ->leftJoin('payment_histories', 'orders.id', '=', 'payment_histories.order_id')
        ->where('payment_status_id', '>=', '3')
        ->where('orders.id', '=', $orderId)
        ->get();
        return $result;
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
        DB::table('orders')
        ->where('id', $id)
        ->update([
            'client_id' => $request->client,
            'user_id' => $request->user,
            'unit_id' => $request->unit,
            'available_status_id' => $request->available_status,
        ]);
        return redirect(route('orders.index'));

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
