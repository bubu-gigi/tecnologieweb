<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestionePrestazioniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'descrizione' => ['required', 'string'],
            'prescrizioni' => ['required', 'string'],
            'medico_id' => ['required'],
            'staff_id' => ['nullable'],
            'orari' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.string' => 'La descrizione deve essere una stringa.',

            'prescrizioni.required' => 'Il campo prescrizioni è obbligatorio.',
            'prescrizioni.string' => 'Le prescrizioni devono essere una stringa.',
        ];
    }
}
