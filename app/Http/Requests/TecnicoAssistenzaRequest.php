<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TecnicoAssistenzaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

 
    public function rules(): array
    {
        return [
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'data_nascita' => 'required|date',
            'specializzazione' => 'nullable|string|max:255',
            'centro_assistenza_id' => 'required|exists:centri_assistenza,id',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Il nome è obbligatorio.',
            'nome.string' => 'Il nome deve essere una stringa.',
            'nome.max' => 'Il nome non può superare i 255 caratteri.',

            'cognome.required' => 'Il cognome è obbligatorio.',
            'cognome.string' => 'Il cognome deve essere una stringa.',
            'cognome.max' => 'Il cognome non può superare i 255 caratteri.',

            'data_nascita.required' => 'La data di nascita è obbligatoria.',
            'data_nascita.date' => 'La data di nascita non è valida.',

            'specializzazione.string' => 'La specializzazione deve essere una stringa.',
            'specializzazione.max' => 'La specializzazione non può superare i 255 caratteri.',

            'centro_assistenza_id.required' => 'Seleziona un centro di assistenza.',
            'centro_assistenza_id.exists' => 'Il centro selezionato non esiste.',

            'username.required' => 'Lo username è obbligatorio.',
            'username.string' => 'Lo username deve essere una stringa.',
            'username.max' => 'Lo username non può superare i 255 caratteri.',
            'username.unique' => 'Questo username è già in uso.',

            'password.required' => 'La password è obbligatoria.',
            'password.string' => 'La password deve essere una stringa.',
            'password.min' => 'La password deve essere lunga almeno 6 caratteri.',
        ];
    }
}
