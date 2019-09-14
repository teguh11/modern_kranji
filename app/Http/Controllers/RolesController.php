<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Permissions;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RolesController extends Controller
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
        return view('layouts.roles.index');
        //
    }

    public function data()
    {
        $roles = Roles::all();
        return DataTables::of($roles)
        ->addColumn('action', function($role){
            return '
            <a href="'.route('roles.edit',['role' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>
            <a href="'.route('roles.create-permission',['id' => $role->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Add Permission</a>';
        })
        ->make(true);
    }

    public function addpermission(Request $request, $id)
    {
        $role = Roles::findById($id);
        // $role = Roles::findById($id)->hasPermissionTo('list-users');
        // dd($role);
        $permissions = Permissions::all();
        return view('layouts.permissions.form', ['type' => 'create', 'role' => $role, 'permissions' => $permissions]);
    }

    public function storepermission(Request $request, $id)
    {
        Roles::findById($id)->syncPermissions($request->post('permission'));
        return redirect(route('roles.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.roles.form', ['type'=>'create']);
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
        Roles::create(['name' => $request->name]);
        return redirect(route('roles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
