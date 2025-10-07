<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MalfunzionamentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descrizione' => ['required', 'string'],
        ];
    }

     public function messages(): array
    {
        return [
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.string' => 'La descrizione deve essere una stringa.',
        ];
    }
}
