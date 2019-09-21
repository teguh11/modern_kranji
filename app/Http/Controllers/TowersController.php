<?php

namespace App\Http\Controllers;

use App\Towers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TowersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.towers.index');
        //
    }

    public function data()
    {
        $roles = Towers::all();
        return DataTables::of($roles)
        ->addColumn('action', function($role){
            return '
            <a href="'.route('towers.edit',['role' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        return view('layouts.towers.form', ['type' => 'create']);
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
            'name' => 'required'
        ]);

        DB::table('towers')->insert(['name' => $request->name]);
        return redirect(route('towers.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Towers  $towers
     * @return \Illuminate\Http\Response
     */
    public function show(Towers $towers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Towers  $towers
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $options = [
            'type' => 'update',
            'data' => Towers::find($id)
        ];
        return view('layouts.towers.form', $options);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Towers  $towers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Towers::where('id', $id)->update(['name' => $request->name]);
        return redirect(route('towers.index'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Towers  $towers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Towers $towers)
    {
        //
    }
}
