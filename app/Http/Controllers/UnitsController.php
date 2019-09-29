<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\AvailableStatus;
use App\Floors;
use App\Units;
use App\UnitTypes;
use App\Http\Requests\UnitRequest;
use App\Towers;
use App\Views;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UnitsController extends Controller
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
    public function index()
    {
        if(auth()->user()->hasRole('kasir')){
            $client =DB::table('clients')->get();
        }else{
            $client = DB::table('clients')->where('user_id', "=" , auth()->user()->id)->get();
        }
        $options = [
            'tipe_units' => UnitTypes::where('status', 1)->get(), 
            'lantais'=> Floors::where('status', 1)->get(),
            'towers' => Towers::where('status', 1)->get(),
            'views' => Views::where('status', 1)->get(),
            'available_statuss' => AvailableStatus::where('status', 1)->get(),
            'clients' => $client,
        ];
        return view('layouts.units.index', $options);
        //
    }

    public function data(Request $request)
    {
        $units = DB::table('unit')->select(['unit.id','unit_number', 'unit_name', 'unit_types.name as unit_type', 'floors.name as floor', 'towers.name as tower', 'large', 'price', 'unit_total', 'unit_stock', 
        'unit.unit_type_id', 'unit.floor_id', 'unit.tower_id', 'unit.view_id',
        'clients.name as client_name', 'clients.id as client_id',
        'available_status.name as available_status_name', 'unit.available_status_id as unit_available_status'
        ])
        ->join('unit_types','unit.unit_type_id', '=', 'unit_types.id')
        ->join('floors','unit.floor_id', '=', 'floors.id')
        ->join('towers','unit.tower_id', '=', 'towers.id')
        ->leftJoin('orders','unit.id', '=', 'orders.unit_id')
        ->leftJoin('clients','orders.client_id', '=', 'clients.id')
        ->leftJoin('available_status','unit.available_status_id', '=', 'available_status.id');
        if(auth()->user()->hasRole('sales')){
            if($request->get('client') == null &&
            $request->get('available_status') == null &&
            $request->get('unit_type') == null &&
            $request->get('floor') == null &&
            $request->get('tower') == null &&
            $request->get('view') == null){
                $units->whereNull('unit.available_status_id');
            }

            $units->orWhere('orders.user_id', '=', auth()->user()->id);
        }
        $units->get();

        $datatables = DataTables::of($units)
        ->filter(function ($query) use ($request)
        {
            if($request->get('unit_type') != null){
                $query->where('unit_type_id', '=', $request->get('unit_type'));
            }
            if($request->get('floor') != null){
                $query->where('floor_id', '=', $request->get('floor'));
            }
            if($request->get('tower') != null){
                $query->where('tower_id', '=', $request->get('tower'));
            }
            if($request->get('view') != null){
                $query->where('view_id', '=', $request->get('view'));
            }
            if($request->get('client') != null){
                $query->where('client_id', '=', $request->get('client'));
            }
            if($request->get('available_status') != null){
                $query->where('unit.available_status_id', '=', $request->get('available_status'));
            }
        });
        $datatables->addColumn('action', function($unit){
            $link_edit_unit = '<a href="'.route('units.edit',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
            $link_create_order = '<a href="'.route('orders.create',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Order</a>';
            $link_view_unit = '<a href="'.route('units.show',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> History</a>';
            $links = "";
            if(auth()->user()->hasRole('administrator')){
                if($unit->unit_available_status == null){
                    $links = $link_edit_unit;
                }
            }elseif (auth()->user()->hasRole(['sales', 'kasir'])) {
                if(auth()->user()->can('view-units') && $unit->client_id != null){
                    $links .= $link_view_unit;
                }
                if(!auth()->user()->hasRole('kasir')){
                    if(auth()->user()->can('create-orders')){
                        $links .= $link_create_order;
                    }
                }

                // if(auth()->user()->can('edit-units')){
                //     $links .= $link_edit_unit;
                // }
            }
            return $links;
        })
        ->editColumn('price', '{{number_format($price, "0", ", ", ".")}}')
        ->editColumn('unit_total', '{{number_format($unit_total, "0", ", ", ".")}}');

        return $datatables->make(true);
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
            'tipe_units' => UnitTypes::where('status', 1)->get(), 
            'lantais'=> Floors::where('status', 1)->get(),
            'towers' => Towers::where('status', 1)->get(),
            'views' => Views::where('status', 1)->get()
        ];
        return view('layouts.units.form', $options);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitRequest $request)
    {
        $validateRequest = $request->validated();

        $insert = DB::table("unit")->insert([
            'unit_number' => str_replace(",","", $request->unit_number),
            'unit_name' => $request->unit_name,
            'unit_type_id' => $request->unit_type,
            'floor_id' => $request->floor,
            'tower_id' => $request->tower,
            'view_id' => $request->view,
            'large' => str_replace(",","", $request->large),
            'price' => str_replace(",","", $request->price),
            'status' => 1
        ]);

        if($insert){
            return redirect(route('units.index'));
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Units  $units
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
        $unit = DB::table('unit')
                ->select([
                    'clients.name as client_name',
                    'clients.handphone as client_phone',
                    'clients.address as client_address',
                    'users.name as user_name',
                    'users.email as user_email',
                    'unit.id',
                    'unit.unit_number as unit_number',
                    'unit.large',
                    'unit.price',
                    'unit.unit_name as unit_name',
                    'unit_types.name as unit_type_name',
                    'floors.name as floor_name',
                    'views.name as view_name',
                    'towers.name as tower_name',
                    'orders.order_number as order_number',
                    'orders.created_at as order_date',
                    'orders.id as order_id',
                ])
                ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
                ->join('floors', 'unit.floor_id', '=', 'floors.id')
                ->join('views', 'unit.view_id', '=', 'views.id')
                ->join('towers', 'unit.tower_id', '=', 'towers.id')
                ->join('orders', 'unit.id', '=', 'orders.unit_id')
                ->join('clients', 'orders.client_id', '=', 'clients.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('available_status', 'unit.available_status_id', '=', 'available_status.id')
                
                ->where('unit.id', '=', $id)->first();

        if($unit == null){
            return redirect(route('units.index'));
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
            'unit' => $unit,
            'transactionHistory' => $transactionHistory 
        ];
        return view('layouts.units.view', $options);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Units  $units
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $unit = Units::where('id', $id)->first();
        if($unit->available_status_id != null){
            return redirect(route('units.index'))->with('error', "Unit ".$unit->unit_name." Tidak Bisa di Rubah!");
        }
        $options = [
            'type' => 'update', 
            'data' => $unit, 
            'tipe_units' => UnitTypes::where('status', 1)->get(), 
            'lantais'=> Floors::where('status', 1)->get(),
            'towers' => Towers::where('status', 1)->get(),
            'views' => Views::where('status', 1)->get()
        ];
        return view('layouts.units.form', $options);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Units  $units
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        $request->validated();
        DB::table("unit")
            ->where('id', $id)
            ->update([
                'unit_number' => str_replace(",","", $request->unit_number),
                'unit_name' => $request->unit_name,
                'unit_type_id' => $request->unit_type,
                'floor_id' => $request->floor,
                'tower_id' => $request->tower,
                'view_id' => $request->view,
                'large' => str_replace(",","", $request->large),
                'price' => str_replace(",","", $request->price),
                // 'unit_total' => str_replace(",","", $request->unit_total),
                // 'unit_stock' => str_replace(",","", $request->unit_total),
                ]);

        return redirect(route('units.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Units  $units
     * @return \Illuminate\Http\Response
     */
    public function destroy(Units $units)
    {
        //
    }


}
