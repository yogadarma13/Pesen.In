<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return response()->json(Menu::all());
    }

    public function store(Request $request)
    {
        // $filename = explode('.', $request->foto->getClientOriginalName());
        // $fileExt = end($filename);
        // $id = $this->generateIdGambar();
        // $filename = $id . '.' . $fileExt;
        // $path = $request->foto->storeAs('image/menu', $filename, 'public_uploads');

        $data = new Menu();
        $data->nama = $request->nama;
        $data->kategori = $request->kategori;
        $data->harga = $request->harga;
        $data->deskripsi = $request->deskripsi;
        $data->foto = $request->foto;
        $data->save();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Menu::find($id);
        if ($data) {
            return response()->json(['message'=>'Data ditemukan'], $data);
        } else {
            // return response()->json(['message'=>'Menu tidak ditemukan']);
            return abort(404, 'Data menu tidak ditemukan');
        }
    }

    public function destroy($id)
    {
        $data = Menu::find($id);

        if ($data) {
            $data->delete();
            return response()->json(['message' => 'Data telah dihapus']);
        } else {
            return abort(404, 'Data menu tidak ditemukan');
        }
    }

    public function generateIdGambar()
    {
        $char = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'a', 'b', 'c', 'd', 'e', 'f'];
        $id = "";
        for ($i = 0; $i < 6; $i++) {
            $id = $id . $char[rand(0, 15)];
        }
        return $id;
    }
}
