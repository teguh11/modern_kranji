<?php

namespace App\Http\Controllers;

use App\Floors;
use App\Units;
use App\UnitTypes;
use App\Http\Requests\UnitRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class UnitsController extends Controller
{
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
        return view('layouts.units.index');
        //
    }

    public function data()
    {
        $units = Units::all(['id','unit_number', 'unit_name', 'unit_type_id', 'floor_id', 'large', 'price', 'unit_total', 'unit_stock']);
        return DataTables::of($units)
        ->addColumn('action', function($unit){
            return '<a href="'.route('units.edit',['unit' => $unit->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipe_unit = UnitTypes::where('status', 1)->get();
        $lantai = Floors::where('status', 1)->get();
        return view('layouts.units.form',['type' => 'create', 'tipe_units' => $tipe_unit, 'lantais'=> $lantai]);
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
            'large' => str_replace(",","", $request->large),
            'price' => str_replace(",","", $request->price),
            'unit_total' => str_replace(",","", $request->unit_total),
            'unit_stock' => str_replace(",","", $request->unit_total),
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
        $unit = Units::where('id', $id)->first(); 
        $tipe_unit = UnitTypes::where('status', 1)->get();
        $lantai = Floors::where('status', 1)->get();
        $options = ['type' => 'update', 'data' => $unit, 'tipe_units' => $tipe_unit, 'lantais'=>$lantai];
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
                'large' => str_replace(",","", $request->large),
                'price' => str_replace(",","", $request->price),
                'unit_total' => str_replace(",","", $request->unit_total),
                'unit_stock' => str_replace(",","", $request->unit_total),
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
