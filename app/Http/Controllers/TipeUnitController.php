<?php

namespace App\Http\Controllers;

use App\TipeUnit;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;

class TipeUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('layouts.tipeunit.index');
    }

    public function dataTipeUnit()
    {
        dd("test");
        $tipeUnits = TipeUnit::select("id","nama", "status")->get();
        return DataTable::of($tipeUnits)->make(true);
        # code...
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd("create");
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
     * @param  \App\TipeUnit  $tipeUnit
     * @return \Illuminate\Http\Response
     */
    public function show(TipeUnit $tipeUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TipeUnit  $tipeUnit
     * @return \Illuminate\Http\Response
     */
    public function edit(TipeUnit $tipeUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TipeUnit  $tipeUnit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipeUnit $tipeUnit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TipeUnit  $tipeUnit
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipeUnit $tipeUnit)
    {
        //
    }
}
