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
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'indirizzo' => ['required', 'string', 'max:255'],
            'citta' => ['required', 'string', 'max:100'],
            'dataNascita' => ['required', 'date', 'before:today'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
    public function messages(): array
    {
        return [
            'birthdate.before' => 'La data di nascita deve essere precedente a oggi.',
            'password.confirmed' => 'Le password non coincidono.',
            'username.unique' => 'Questo username è già in uso.',
        ];
    }
}
