<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Za-zÀ-ÿ\'\-\s]+$/u'],
            'cognome' => ['required', 'string', 'min:2', 'max:255', 'regex:/^[A-Za-zÀ-ÿ\'\-\s]+$/u'],
            'data_nascita' => ['required', 'date', 'before:today'],
            'indirizzo' => ['required', 'string', 'min:4', 'max:255'],
            'citta' => ['required', 'string', 'min:2', 'max:100'],
            'username' => ['required', 'string', 'min:6', 'max:255', 'unique:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Il nome è obbligatorio.',
            'nome.min' => 'Il nome è troppo corto.',
            'nome.regex' => 'Il nome può contenere solo lettere, spazi e apostrofi.',

            'cognome.required' => 'Il cognome è obbligatorio.',
            'cognome.min' => 'Il cognome è troppo corto.',
            'cognome.regex' => 'Il cognome può contenere solo lettere, spazi e apostrofi.',

            'data_nascita.required' => 'La data di nascita è obbligatoria.',
            'data_nascita.before' => 'La data di nascita deve essere precedente a oggi.',

            'indirizzo.required' => 'L\'indirizzo è obbligatorio.',
            'indirizzo.min' => 'L\'indirizzo è troppo corto.',

            'citta.required' => 'La città è obbligatoria.',
            'citta.min' => 'La città è troppo corta.',

            'username.required' => 'Lo username è obbligatorio.',
            'username.min' => 'Lo username deve contenere almeno 6 caratteri.',
            'username.unique' => 'Questo username è già in uso.',

            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password deve contenere almeno 8 caratteri.',
            'password.confirmed' => 'Le password non coincidono.',
        ];
    }
}
