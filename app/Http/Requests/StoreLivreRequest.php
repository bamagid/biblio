<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLivreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "categorie_id" => ['required', 'string', 'exists:categories,id'],
            "isbn" => ['required', 'string', 'unique:livres,isbn'],
            "date_publication" => ['required', 'date', 'before:now'],
            "titre" => ['required', 'string', 'min:5', 'max:255'],
            "auteur" => ['required', 'string', 'min:3', 'max:255'],
            "quantite" => ['required', 'integer', 'min:1'],
            "image" => ['required', "image", "mimes:png,jpg,jpeg", "max:2048"]
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
