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
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
        ];
    }
}
