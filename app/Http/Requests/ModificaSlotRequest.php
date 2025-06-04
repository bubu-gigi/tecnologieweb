<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModificaSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'data_prenotazione' => ['required', 'date'],
        ];
    }
}
