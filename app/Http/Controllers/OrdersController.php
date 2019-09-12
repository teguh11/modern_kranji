<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Pembeli;
use App\Units;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class OrdersController extends Controller
{
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
        // $orders = Orders::all(['no_order', 'pembeli_id', 'user_id', 'nominal', 'unit_id', 'payment_method', 'payment_date', 'refundable_status']);
        $orders = DB::table('orders')
            ->select('no_order', 'pembeli.nama as pembeli', 'users.nama as user', 'nominal', 'unit.nama as unit', 'payment_method', 'payment_date', 'refundable_status')
            ->join('pembeli', 'orders.pembeli_id', '=', 'pembeli.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('unit', 'orders.unit_id', '=', 'unit.id')
            ->get();
        return DataTables::of($orders)->addColumn('action', function($order)
        {
            return '<a href="'.route('pembeli.update.form',['id' => $order->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })->make(true);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $units = Units::where('status', 1)->get();
        $pembelis = Pembeli::where('status', 1)->get();
        $users = User::all();
        return view('layouts.orders.form', ['type' => 'create', 'units' => $units, 'pembelis' => $pembelis, 'users' => $users]);
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
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        //
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
