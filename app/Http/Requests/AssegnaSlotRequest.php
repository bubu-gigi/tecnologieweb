<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssegnaSlotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prenotazione_id' => ['required', 'integer'],
            'data' => ['required', 'date'],
            'slot_orario' => ['required', 'string'],
        ];
    }
}
