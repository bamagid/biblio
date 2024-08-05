<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateLivreRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "categorie_id" => ['sometimes', 'integer', 'exists:categories,id'],
            "isbn" => ['sometimes', 'string', 'unique:livres,isbn'],
            "date_publication" => ['sometimes', 'date', 'before:now'],
            "titre" => ['sometimes', 'string', 'min:5', 'max:100'],
            "auteur" => ['sometimes', 'string', 'min:3', 'max:100'],
            "quantite" => ['sometimes', 'integer', 'min:1'],
            "image" => ['sometimes', "image", "mimes:png,jpg,jpeg", "max:2048"],
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
