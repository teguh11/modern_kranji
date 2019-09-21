<?php

namespace App\Http\Controllers;

use App\Floors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.floors.index');
        //
    }

    public function data()
    {
        $roles = Floors::all();

        return DataTables::of($roles)
        ->addColumn('action', function($role){
            return '
            <a href="'.route('floors.edit',['role' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        return view('layouts.floors.form', ['type' => 'create']);
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
        $request->validate([
            'name' => 'required',
        ]);
        DB::table('floors')->insert(['name' => $request->name]);
        return redirect(route('floors.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floors  $floors
     * @return \Illuminate\Http\Response
     */
    public function show(Floors $floors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floors  $floors
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $options = [
            'type' => 'update',
            'data' => Floors::find($id)
        ];
        return view('layouts.floors.form', $options);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floors  $floors
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        Floors::where('id', $id)->update(['name' => $request->name]);
        return redirect(route('floors.index'));
        //unit-type
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floors  $floors
     * @return \Illuminate\Http\Response
     */
    public function destroy(Floors $floors)
    {
        //
    }
}
