<?php

namespace App\Http\Controllers;

use App\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Meja::all());
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
        $meja = new Meja();
        $meja->status = 0;
        $meja->save();
        return response()->json(["Message"=>"Meja telah ditambahkan"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meja = Meja::find($id);
        if($meja){
            return response()->json($meja);
        }
        return response()->json(404, "Data tidak ditemukan");
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
        $meja = Meja::find($id);

        if($meja){
            $meja->status = 0;
            $meja->save();
            return response()->json(["message"=>"Data meja telah diperbaharui"]);
        }
        return response()->json(["message"=>"Data nomor tidak ditemukan"]);
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

    public function updateMeja(Request $request){
        $meja = Meja::find($request->nomor);

        if($meja){
            $meja->status = 0;
            $meja->save();
            return response()->json(["message-succes"=>"Data meja telah diperbaharui"]);
        }
        return response()->json(["message"=>"Data nomor tidak ditemukan"]);

    }
}
