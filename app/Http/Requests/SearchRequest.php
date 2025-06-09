<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'prestazione' => ['nullable', 'regex:/^[^\d]+$/'],
            'dipartimento' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'prestazione.regex' => 'Il campo prestazione non può contenere numeri.',
        ];
    }
}

