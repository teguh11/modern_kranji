<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Clients;
use App\Banks;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ClientsController extends Controller
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
        return view('layouts.clients.index');
        //
    }

    public function data()
    {
        $clients = Clients::select(['clients.id', 'clients.name', 'clients.email', 'clients.handphone',
            'users.id as user_id', 'users.name as user_name'
        ]);
        if(!auth()->user()->hasRole(['administrator', 'kasir'])){
            $clients->where("user_id", "=", Auth::user()->id);
        }
        $clients->join('users', 'clients.user_id', '=', 'users.id');
        $clients->get();

        return Datatables::of($clients)
        ->addColumn('action', function($client)
        {
            return '<a href="'.route('clients.edit',['client' => $client->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        $options = [
            'type' => 'create',
            'banks' => Banks::select('id', 'name')->orderBy('name', 'asc')->get()
        ];
        return view('layouts.clients.form', $options );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $request->validated();
        $file = "";
        if($request->hasFile('identity_file')){
            $file = $request->file('identity_file')->store(env("CLIENT_DIR").date("Y/m/d"));
            $file = str_replace("public/", "", $file);
        }

        $insert = DB::table("clients")->insert([
            'user_id' => Auth::user()->id,
            'order_number' => "CL_". Auth::user()->id."_".strtotime(date("YmdHis")),
            'name' => $request->name,
            'email' => $request->email,
            'identity_no' => $request->identity_no,
            'identity_file' => $file,
            'npwp' => $request->npwp,
            'telp_rumah' => $request->telp_rumah,
            'telp_kantor' => $request->telp_kantor,
            'handphone' => $request->handphone,
            'address' => $request->address,
            'bank_id' => $request->bank,
            'account_name' => $request->account_name,
            'account_number' => $request->account_number
        ]);

        return redirect(route('clients.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function show(Clients $clients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $client = Clients::where('id', $id)->first();
        $options = [
            'type' => 'update', 
            'data' => $client, 
            'banks' => Banks::select('id', 'name')->orderBy('name', 'asc')->get()
        ];
        return view('layouts.clients.form', $options );
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function update(ClientRequest $request, $id)
    {
        $file = "";
        if($request->hasFile('identity_file')){
            $file = $request->file('identity_file')->store(env("CLIENT_DIR").date("Y/m/d"));
            $file = str_replace("public/", "", $file);
        }

        $request->validated();
        $update = DB::table("clients")
            ->where('id', $id)
            ->update([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'identity_no' => $request->identity_no,
                'identity_file' => $file,
                'npwp' => $request->npwp,
                'telp_rumah' => $request->telp_rumah,
                'telp_kantor' => $request->telp_kantor,
                'handphone' => $request->handphone,
                'address' => $request->address,
                'bank_id' => $request->bank,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number
            ]);
        return redirect(route('clients.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clients  $clients
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clients $clients)
    {
        //
    }
}
