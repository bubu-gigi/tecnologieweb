<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchDipartimentoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dipartimento' => ['required', 'regex:/^[^\d]+$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'dipartimento.required' => 'Il campo dipartimento è obbligatorio.',
            'dipartimento.regex' => 'Il campo dipartimento non può contenere numeri.',
        ];
    }
}
