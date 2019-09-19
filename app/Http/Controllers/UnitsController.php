<?php

namespace App\Http\Controllers;

use App\Authorizable;
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
        $options = [
            'tipe_units' => UnitTypes::where('status', 1)->get(), 
            'lantais'=> Floors::where('status', 1)->get(),
            'towers' => Towers::where('status', 1)->get(),
            'views' => Views::where('status', 1)->get()
        ];
        return view('layouts.units.index', $options);
        //
    }

    public function data(Request $request)
    {
        $units = DB::table('unit')->select(['unit.id','unit_number', 'unit_name', 'unit_types.name as unit_type', 'floors.name as floor', 'towers.name as tower', 'large', 'price', 'unit_total', 'unit_stock', 
        'unit.unit_type_id', 'unit.floor_id', 'unit.tower_id', 'unit.view_id'
        ])
        ->join('unit_types','unit.unit_type_id', '=', 'unit_types.id')
        ->join('floors','unit.floor_id', '=', 'floors.id')
        ->join('towers','unit.tower_id', '=', 'towers.id')
        ->get();
        
        $datatables = DataTables::of($units)
        ->filter(function ($instance) use ($request)
        {
            if($request->get('unit_type') != null){
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return $row['unit_type_id'] == $request->get('unit_type') ? true : false;
                });
            }
            if($request->get('floor') != null){
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return $row['floor_id'] == $request->get('floor') ? true : false;
                });
            }
            if($request->get('tower') != null){
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return $row['tower_id'] == $request->get('tower') ? true : false;
                });
            }
            if($request->get('view') != null){
                $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                    return $row['view_id'] == $request->get('view') ? true : false;
                });
            }
        });
        $datatables->addColumn('action', function($unit){
            return '<a href="'.route('units.edit',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->editColumn('price', '{{number_format($price, "0", ", ", ".")}}')
        ->editColumn('unit_total', '{{number_format($unit_total, "0", ", ", ".")}}');

        return $datatables->make(true);
        // ->filter(function ($query) use ($request)
        // {
        //     if($request->has('unit_type')){
        //         $query->where('unit_type_id', '=', $request->unit_type);
        //     }
        //     if($request->has('floor')){
        //         $query->where('floor_id', '=', $request->floor);
        //     }
        //     if($request->has('tower')){
        //         $query->where('tower_id', '=', $request->tower);
        //     }
        //     if($request->has('view')){
        //         $query->where('view_id', '=', $request->view);
        //     }
        // })
        // ->addColumn('action', function($unit){
        //     return '<a href="'.route('units.edit',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        // })
        // ->editColumn('price', '{{number_format($price, "0", ", ", ".")}}')
        // ->editColumn('unit_total', '{{number_format($unit_total, "0", ", ", ".")}}')
        // ->make(true);
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
            // 'unit_total' => str_replace(",","", $request->unit_total),
            // 'unit_stock' => str_replace(",","", $request->unit_total),
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
        ->select('unit.unit_name', 'unit.large as large', 'unit_types.name as unit_type_name', 'floors.name as floor', 'unit.price as price')
        ->join('unit_types', 'unit.unit_type_id', '=', 'unit_types.id')
        ->join('floors', 'unit.floor_id', '=', 'floors.id')
        ->where("unit.id", "=", $id)
        ->first();
        echo json_encode($unit);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Units  $units
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $options = [
            'type' => 'update', 
            'data' => Units::where('id', $id)->first(), 
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
