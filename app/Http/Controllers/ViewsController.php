<?php

namespace App\Http\Controllers;

use App\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ViewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.views.index');
        //
    }

    public function data()
    {
        $roles = Views::all();
        return DataTables::of($roles)
        ->addColumn('action', function($role){
            return '
            <a href="'.route('views.edit',['role' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        return view('layouts.views.form', ['type' => 'create']);
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

        DB::table('views')->insert(['name' => $request->name]);
        return redirect(route('views.index'));
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function show(Views $views)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {  
        $options = [
            'type' => 'update',
            'data' => Views::find($id)
        ];
        return view('layouts.views.form', $options);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Views::where('id', $id)->update(['name' => $request->name]);
        return redirect(route('views.index'));
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Views  $views
     * @return \Illuminate\Http\Response
     */
    public function destroy(Views $views)
    {
        //
    }
}
