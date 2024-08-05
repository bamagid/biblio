<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "nom" => "required|string",
            "prenom" => "required|string",
            "email" => "required|string|email|unique:users",
            "password" => "required|confirmed"
        ];
    }
    public function FailedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['success' => false,             'errors' => $validator->errors()],
            422
        ));
    }
}
