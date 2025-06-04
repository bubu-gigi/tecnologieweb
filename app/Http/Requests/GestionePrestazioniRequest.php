<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GestionePrestazioniRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $giorni = $this->input('giorno', []);
            $starts = $this->input('start_time', []);
            $ends = $this->input('end_time', []);

            foreach ($giorni as $index => $giorno) {
                $start = $starts[$index] ?? null;
                $end = $ends[$index] ?? null;

                if ($start && $end && $end <= $start) {
                    $validator->errors()->add("end_time.$index", "L'orario di fine deve essere successivo a quello di inizio per la fascia #".($index+1));
                }
            }
        });
    }

    public function rules(): array
    {
        return [
            'descrizione' => ['required', 'string', 'max:255'],
            'prescrizioni' => ['required', 'string'],
            'medico_id' => ['required'],
            'staff_id' => ['nullable'],

            'start_time' => ['nullable'],
            'start_time.*' => ['required', 'after_or_equal:08:00', 'before_or_equal:19:00'],
            'end_time' => ['nullable'],
            'end_time.*' => ['required', 'after:start_time.*', 'before_or_equal:20:00'],
        ];
    }

    public function messages(): array
    {
        return [
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.string' => 'La descrizione deve essere una stringa.',
            'descrizione.max' => 'La descrizione non può superare i 255 caratteri.',
            
            'prescrizioni.required' => 'Il campo prescrizioni è obbligatorio.',
            'prescrizioni.string' => 'Le prescrizioni devono essere una stringa.',

            'start_time.after_or_equal' => 'La prestazione non può essere erogata prima delle 08:00.',
            'start_time.before_or_equal' => 'La prestazione non può essere erogata dopo le 19:00.',

            'end_time.after_or_equal' => 'La fascia oraria deve avere almeno un ora di durata.',
            'end_time.before_or_equal' => 'La fascia oraria non può finire dopo le 20:00',
        ];
    }
}
