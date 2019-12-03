<?php

namespace App\Http\Controllers;

use App\Pembayaran;
use App\Pesan;
use App\User;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Pembayaran::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $pesan = Pesan::find($request->id);
        if($pesan){
            $pembayaran = new Pembayaran();
            $pembayaran->nomor_order = $pesan->nomor;

            $pemesan = User::where('id', $pesan->id_user)->first();
            $pembayaran->nama = $pemesan->nama;
            $pembayaran->total = $pesan->total_harga;
            $pembayaran->save();

            // $pesan->delete();

            return response()->json(["message_success"=>"Pesanan telah dibayar"]);

        }
        return response()->json(["message"=>"Gagal"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function simpan($id){

    }
}
