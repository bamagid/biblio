<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEmpruntRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => ["required", "integer", "exists:users,id"],
            "livre_id" => ["required", "integer", "exists:livres,id"],
            "date_emprunt" => ["sometimes", "date"],
            "date_retour_prevue" => ["required", "date", "after:now"],
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "success" => false,
                    "errors" => $validator->errors()
                ],
                422
            )
        );
    }
}
