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
        $isUpdate = $this->isMethod('put');
        $userId = $this->route('id');

        return [
            'nome' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'cognome' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\s]+$/u'],
            'username' => [
                'required',
                'string',
                'max:255',
                $isUpdate
                    ? 'unique:users,username,' . $userId
                    : 'unique:users,username',
            ],
            'password' => [
                $isUpdate ? 'nullable' : 'required',
                'string',
                'min:8',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Il campo nome è obbligatorio.',
            'nome.regex' => 'Il campo nome può contenere solo lettere',
            'cognome.required' => 'Il campo cognome è obbligatorio.',
            'cognome.regex' => 'Il campo cognome può contenere solo lettere',
            'username.required' => 'Il campo username è obbligatorio.',
            'username.unique' => 'Questo username è già in uso.',
            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password deve essere lunga almeno 8 caratteri.',
        ];
    }
}
