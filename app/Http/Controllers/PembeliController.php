<?php

namespace App\Http\Controllers;

use App\Http\Requests\PembeliRequest;
use App\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

// use App\Http\Requests\PembeliRequest;

class PembeliController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
	}
	
	public function index()
    {
        return view('layouts.pembeli.index');
    }

    public function datapembeli()
    {
        $pembelis = Pembeli::select('id', 'nama', 'email', 'handphone')->where("user_id", "=", Auth::user()->id)->get();
        return Datatables::of($pembelis)
        ->addColumn('action', function($pembeli)
        {
            return '<a href="'.route('pembeli.update.form',['id' => $pembeli->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';
        })
        ->make(true);
    }

    public function createForm()
    {
        return view('layouts.pembeli.add', ['type' => 'create']);
    }

    public function updateForm(Request $request)
    {
        $pembeli = Pembeli::where('id', $request->query('id'))->first();
        return view('layouts.pembeli.add', ['type' => 'update', 'pembeli' => $pembeli]);
    }

    public function create(PembeliRequest $request)
    {
        $validateRequest = $request->validated();

        $insert = DB::table("pembeli")->insert([
            'user_id' => Auth::user()->id,
            'no_surat_pemesanan' => "CL_". Auth::user()->id,
            'nama' => $request->nama,
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

    public function update(PembeliRequest $request, $id)
    {
        $validateRequest = $request->validated();
        $update = DB::table("pembeli")
            ->where('id', $id)
            ->update([
                'user_id' => Auth::user()->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_ktp' => $request->no_ktp,
                'npwp' => $request->npwp,
                'telp_rumah' => $request->telp_rumah,
                'telp_kantor' => $request->telp_kantor,
                'handphone' => $request->handphone,
                'alamat' => $request->alamat
            ]);

        if($update){
            return redirect(route('pembeli'));
        }
        
    }

    
}
