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
            'descrizione' => ['required', 'string', 'max:255'],
            'prescrizioni' => ['required', 'string'],
            'medico_id' => ['required'],
            'staff_id' => ['nullable'],
            'orari' => ['nullable', 'json'], 
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $rawOrari = $this->input('orari');

            if (!$rawOrari) return;

            $decoded = json_decode($rawOrari, true);

            if (!is_array($decoded)) {
                $validator->errors()->add('orari', 'Il campo orari non contiene un JSON valido.');
                return;
            }

            foreach ($decoded as $index => $entry) {
                if (
                    !isset($entry['giorno'], $entry['start'], $entry['end']) ||
                    !is_int($entry['giorno']) ||
                    !is_int($entry['start']) ||
                    !is_int($entry['end'])
                ) {
                    $validator->errors()->add("orari.$index", "I dati della fascia ".($index + 1)." non sono validi.");
                    continue;
                }

                if ($entry['end'] <= $entry['start']) {
                    $validator->errors()->add("orari.$index", "L'orario di fine deve essere successivo a quello di inizio per la fascia #".($index + 1));
                }

                if ($entry['start'] < 8 || $entry['start'] > 20 || $entry['end'] < 8 || $entry['end'] > 20) {
                    $validator->errors()->add("orari.$index", "Gli orari devono essere compresi tra 0 e 24 per la fascia #".($index + 1));
                }

                if ($entry['giorno'] < 1 || $entry['giorno'] > 6) {
                    $validator->errors()->add("orari.$index", "Il giorno deve essere compreso tra 1 (Lunedì) e 6 (Sabato) per la fascia #".($index + 1));
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.string' => 'La descrizione deve essere una stringa.',
            'descrizione.max' => 'La descrizione non può superare i 255 caratteri.',

            'prescrizioni.required' => 'Il campo prescrizioni è obbligatorio.',
            'prescrizioni.string' => 'Le prescrizioni devono essere una stringa.',

            'orari.json' => 'Il campo orari deve essere un JSON valido.',
        ];
    }
}
