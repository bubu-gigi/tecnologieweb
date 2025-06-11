<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestioneDipartimentiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'regex:/^[a-zA-Z\s]+$/'],
            'descrizione' => ['required', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Il campo nome è obbligatorio.',
            'nome.regex' => 'Il nome può contenere solo lettere e spazi.',
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.max' => 'La descrizione non può superare i 100 caratteri.',
        ];
    }
}
