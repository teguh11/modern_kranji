<?php

namespace App\Http\Controllers;

use App\UnitTypes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class UnitTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.unit_types.index');
        //
    }

    public function data()
    {
        $roles = UnitTypes::all();
        return DataTables::of($roles)
        ->addColumn('action', function($role){
            return '
            <a href="'.route('unit-type.edit',['role' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        //
        return view('layouts.unit_types.form', ['type' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::table('unit_types')->insert(['name' => $request->name, 'status' => 1]);
        return redirect(route('unit-type.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UnitTypes  $unitTypes
     * @return \Illuminate\Http\Response
     */
    public function show(UnitTypes $unitTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UnitTypes  $unitTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $options = [
            'type' => 'update',
            'data' => UnitTypes::find($id)
        ];
        return view('layouts.unit_types.form', $options);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UnitTypes  $unitTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        UnitTypes::where('id', $id)->update(['name' => $request->name]);
        return redirect(route('unit-type.index'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UnitTypes  $unitTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitTypes $unitTypes)
    {
        //
    }
}
