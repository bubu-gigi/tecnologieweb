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
            'nome' => ['required', 'string', 'min:2', 'max:255'],
            'cognome' => ['required', 'string', 'min:2', 'max:255'],
            'indirizzo' => ['required', 'string', 'min:4', 'max:255'],
            'citta' => ['required', 'string', 'min:2', 'max:100'],
            'dataNascita' => ['required', 'date', 'before:today'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function messages(): array
    {
        return [
            'nome.min' => 'Il nome è troppo corto.',
            'cognome.min' => 'Il cognome è troppo corto.',
            'indirizzo.min' => 'L\'indirizzo è troppo corto.',
            'città.min' => 'La città è troppo corto.',
            'nome.required' => 'Il nome è obbligatorio.',
            'cognome.required' => 'Il cognome è obbligatorio.',
            'indirizzo.required' => 'L\'indirizzo è obbligatorio.',
            'citta.required' => 'La città è obbligatoria.',
            'dataNascita.required' => 'La data di nascita è obbligatoria.',
            'username.required' => 'Lo username è obbligatorio.',
            'password.required' => 'La password è obbligatoria',
            'dataNascita.before' => 'La data di nascita deve essere precedente a oggi.',
            'password.confirmed' => 'Le password non coincidono.',
            'username.unique' => 'Questo username è già in uso.',
        ];
    }
}
