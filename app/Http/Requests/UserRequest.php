<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $method = strtoupper(request()->method());

        // if ($method == 'POST') {
            return [
                'nama' => 'required|string|min:2|max:100',
                'noTelephone' => 'required|string|min:2|max:15',
                'email' => 'required|string|email|unique:users',
                'password' => 'required|string|min:4|max:50',
            ];
        // }
        // else if ($method == 'PUT') {
        //     return [
        //         'nama' => 'required|string|min:2|max:100',
        //         'noTelephone' => 'required|string|min:2|max:15',
        //         'password' => 'required|string|min:4|max:50',

        //     ];
        // }
    }
}
