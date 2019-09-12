<?php

namespace App\Http\Controllers;

use App\Clients;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class ClientsController extends Controller
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
        return view('layouts.clients.index');
        //
    }

    public function data()
    {
        $clients = Clients::select('id', 'name', 'email', 'handphone')->where("user_id", "=", Auth::user()->id)->get();
        return Datatables::of($clients)
        ->addColumn('action', function($client)
        {
            return '<a href="'.route('clients.edit',['clients' => $client->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
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
        return view('layouts.clients.form', ['type' => 'create']);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $validateRequest = $request->validated();

        $insert = DB::table("pembeli")->insert([
            'user_id' => Auth::user()->id,
            'order_number' => "CL_". Auth::user()->id."_".date("YmdHis"),
            'name' => $request->nama,
            'email' => $request->email,
            'no_ktp' => $request->no_ktp,
            'npwp' => $request->npwp,
            'telp_rumah' => $request->telp_rumah,
            'telp_kantor' => $request->telp_kantor,
            'handphone' => $request->handphone,
            'alamat' => $request->alamat
        ]);

        if($insert){
            return redirect(route('pembeli'));
        }
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
        return view('layouts.clients.form', ['type' => 'update', 'data' => $client]);
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
        $validateRequest = $request->validated();
        $update = DB::table("clients")
            ->where('id', $id)
            ->update([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'identity_no' => $request->identity_no,
                'npwp' => $request->npwp,
                'telp_rumah' => $request->telp_rumah,
                'telp_kantor' => $request->telp_kantor,
                'handphone' => $request->handphone,
                'address' => $request->address
            ]);

        if($update){
            return redirect(route('clients.index'));
        }
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
