<?php

namespace App\Http\Controllers;

use App\User;
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

}
