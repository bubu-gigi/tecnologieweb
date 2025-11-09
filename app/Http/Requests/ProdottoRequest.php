<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdottoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4'],
            'descrizione' => ['required', 'string', 'min:4'],
            'note_uso' => ['required', 'string', 'min:4'],
            'mod_installazione' => ['required', 'string', 'min:4'],
            'staff_id' => 'nullable',
            'image' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:4096'],
        ];
    }

     public function messages(): array
    {
        return [
            'name.required' => 'Il campo nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'descrizione.required' => 'Il campo descrizione è obbligatorio.',
            'descrizione.string' => 'La descrizione deve essere una stringa.',
            'note_uso.required' => 'Il campo note d\'uso è obbligatorio.',
            'note_uso.string' => 'Le note d\'uso devono essere una stringa.',
            'mod_installazione.required' => 'Il campo modalità di installazione è obbligatorio.',
            'mod_installazione.string' => 'La modalità di installazione deve essere una stringa.',
            'name.min' => 'Il nome deve contenere almeno :min caratteri.',
            'descrizione.min' => 'La descrizione deve contenere almeno :min caratteri.',
            'note_uso.min' => 'Le note d\'uso devono contenere almeno :min caratteri.',
            'mod_installazione.min' => 'La modalità di installazione deve contenere almeno :min caratteri.',
        ];
    }
}
