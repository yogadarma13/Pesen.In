<?php

namespace App\Http\Controllers;

use App\User;
use App\Menu;
use App\Meja;
use App\Pesan;
use App\Http\Requests\UserRequest;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(UserRequest $request)
    {
        $data = new User();
        $data->nama = $request->nama;
        $data->noTelephone = $request->noTelephone;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        $data->save();
        return response()->json($data);
    }

    public function show($id)
    {
        $data = Menu::find($id);
        if ($data) {
            return response()->json($data);
        } else {
            // return response()->json(['message'=>'Menu tidak ditemukan']);
            return abort(404, 'Data menu tidak ditemukan');
        }
    }

    public function update(Request $request, $id){
        $data = User::find($id);
        if($data){
            if($data->email == $request->loggedin_email){
                $data->nama = $request->nama;
                $data->save();

                return response()->json($data);
            } else{
                return response()->json("jangan ngaku-ngaku deh");
            }

        }
    }


    private function jwtGenerator($email){
        $payload = [
            'iss' => "Pesen.In", // Issuer of the token
            'email' => $email, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + (60 * 60 * 24 * 365), // Expiration time
        ];

        return JWT::encode($payload, env('SECRET_TOKEN_KEY', 'Pesen.In'));
    }

    public function login(Request $request){
        $user = User::where('email', $request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)){
                $token = $this->jwtGenerator($request->email);
                return response()->json([
                    "token" => $token
                ]);
            }
            return abort(401, "Password salah");
        }
        return abort(404, "User tidak ditemukan");
    }

    public function pesan(Request $request){
        $user = User::where('email', $request->loggedin_email)->first();
        if($user){
            $pesan = new Pesan();
            $pesan->id_user = $user->id;


            $meja = Meja::where('status', 0)->first();
            if($meja){
                $pesan->nomor_meja = $meja->nomor;
                $meja->status = 1;

                $pesan->total_harga =  $request->total_harga;
                $pesan->id_menu = "123";

                $meja->save();
                $pesan->save();

                return response()->json($pesan);
            }

            return response()->json(["message"=>"Meja sedah penuh"]);

        }
        return response()->json(["message"=>"Anda belum login"]);

    }

}
