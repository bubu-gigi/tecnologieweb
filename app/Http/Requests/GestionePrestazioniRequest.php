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
            'descrizione' => 'required|string|max:255',
            'prescrizioni' => 'nullable|string',
            'medico_id' => 'required|exists:medici,id',
            'staff_id' => 'nullable|exists:users,id',
        ];
    }
}
