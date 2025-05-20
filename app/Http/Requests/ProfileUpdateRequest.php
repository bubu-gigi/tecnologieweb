<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'indirizzo' => ['required', 'string', 'min:4', 'max:255'],
            'citta' => ['required', 'string', 'min:2', 'max:100'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'indirizzo.required' => 'L\'indirizzo è obbligatorio.',
            'indirizzo.min' => 'L\'indirizzo è troppo corto.',
            'citta.required' => 'La città è obbligatoria.',
            'citta.min' => 'La città è troppo corta.',
            'password.min' => 'La nuova password deve contenere almeno 8 caratteri.',
            'password.confirmed' => 'Le password non coincidono.',
        ];
    }
}
