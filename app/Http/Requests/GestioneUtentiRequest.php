<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestioneUtentiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdate = $this->isMethod('put') || $this->isMethod('patch');
        $userId = $this->route('id'); // prende l'id dalla rotta (per escluderlo nell'unicità dello username)

        return [
            'nome' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? 'unique:users,username,' . $userId // ignora l'utente attuale se è update
                    : 'unique:users,username',
            ],
            'password' => [
                $isUpdate ? 'nullable' : 'required', // password obbligatoria solo in creazione
                'string',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Il campo nome è obbligatorio.',
            'cognome.required' => 'Il campo cognome è obbligatorio.',
            'username.required' => 'Il campo username è obbligatorio.',
            'username.unique' => 'Questo username è già in uso.',
            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password deve essere lunga almeno 8 caratteri.',
        ];
    }
}
