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
            'data_inizio' => ['after_or_equal:2025-06-01','before_or_equal:2025-06-30'],
            'data_fine' => ['after_or_equal:data_inizio', 'before_or_equal:2025-06-30'],
            'utente_esterno' => ['nullable'],
        ];
    }

    public function messages()
    {
        return [
            'data_inizio.after_or_equal' => 'La data di inizio non può essere precedente al 1 giugno 2025.',
            'data_inizio.before_or_equal' => 'La data di inizio non può essere successiva al 30 giugno 2025.',

            'data_fine.after_or_equal' => 'La data di fine deve essere uguale o successiva alla data di inizio.',
            'data_fine.before_or_equal' => 'La data di fine non può essere successiva al 30 giugno 2025.',
        ];
    }
}
