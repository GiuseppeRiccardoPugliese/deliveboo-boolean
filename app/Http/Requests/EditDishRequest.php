<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visible' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'description.required' => 'La descrizione è obbligatoria.',
            'description.string' => 'La descrizione deve essere una stringa.',
            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo minimo consentito è :min.',
            'price.max' => 'Il prezzo massimo consentito è :max.',
            'image.required' => 'L\'immagine è obbligatoria.',
            'image.image' => 'Il file caricato deve essere un\'immagine.',
            'image.mimes' => 'Il formato dell\'immagine deve essere JPEG, PNG, JPG o GIF.',
            'image.max' => 'La dimensione massima consentita per l\'immagine è 2MB.',
            'visible.boolean' => 'Il campo visibilità deve essere un valore booleano (true/false).',
        ];
    }
}
