<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatisticheRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'utente_id' => ['nullable', 'exists:utenti,id']
        ];
    }

    public function messages()
    {
        return [
            'data_inizio.required' => 'La data di inizio è obbligatoria.',
            'data_inizio.date' => 'La data di inizio non è valida.',
            'data_inizio.before_or_equal' => 'La data di inizio deve essere precedente o uguale alla data di fine.',

            'data_fine.required' => 'La data di fine è obbligatoria.',
            'data_fine.date' => 'La data di fine non è valida.',
            'data_fine.after_or_equal' => 'La data di fine deve essere successiva o uguale alla data di inizio.',

            'utente_id.exists' => 'L\'utente selezionato non esiste.',
        ];
    }
}
