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
            'isbn' => ["sometimes", "string", "unique:livres,isbn"],
            'titre' => ['sometimes', 'string', 'max:255'],
            'auteur' => ['sometimes', 'string', 'max:255'],
            'date_publication' => ['sometimes', 'date', 'before:now'],
            "quantite" => ['sometimes', "integer", "min:1"],
            'photo' => ['sometimes', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            ['success' => false,             'errors' => $validator->errors()],
            422
        ));
    }
}
