<?php

namespace App\Http\Controllers;

use App\TipeUnit;
use App\Units;
use App\Lantai;
use App\Http\Requests\UnitRequest;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class UnitsController extends Controller
{
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
        $units = Units::all(['id','no_unit', 'nama_unit', 'tipe_unit', 'lantai', 'luas', 'harga_pengikatan', 'jumlah_unit', 'stock_unit']);
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
        $tipe_unit = TipeUnit::where('status', 1)->get();
        $lantai = Lantai::where('status', 1)->get();
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
            'no_unit' => str_replace(",","", $request->no_unit),
            'nama_unit' => $request->nama_unit,
            'tipe_unit' => $request->tipe_unit,
            'lantai' => str_replace(",","", $request->lantai),
            'luas' => str_replace(",","", $request->luas),
            'harga_pengikatan' => str_replace(",","", $request->harga_pengikatan),
            'jumlah_unit' => str_replace(",","", $request->jumlah_unit),
            'stock_unit' => str_replace(",","", $request->jumlah_unit),
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
    public function show(Units $units)
    {
        dd("show");
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
        $tipe_unit = TipeUnit::where('status', 1)->get();
        $lantai = Lantai::where('status', 1)->get();
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
        $update = DB::table("unit")
            ->where('id', $id)
            ->update([
                'no_unit' => str_replace(",","", $request->no_unit),
                'nama_unit' => $request->nama_unit,
                'tipe_unit' => $request->tipe_unit,
                'lantai' => str_replace(",","", $request->lantai),
                'luas' => str_replace(",","", $request->luas),
                'harga_pengikatan' => str_replace(",","", $request->harga_pengikatan),
                'jumlah_unit' => str_replace(",","", $request->jumlah_unit),
            ]);

        if($update){
            return redirect(route('unit.index'));
        }
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
