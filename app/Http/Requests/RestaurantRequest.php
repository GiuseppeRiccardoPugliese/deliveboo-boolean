<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'piva' => ['required', 'min:11', 'max:11', 'regex:/^[0-9]{11}$/'],
            'address' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'visible' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere una stringa.',
            'name.max' => 'Il nome non può superare i 255 caratteri.',
            'piva.required' => 'La partita IVA è obbligatoria.',
            'piva.min' => 'La partita IVA deve essere composta da 11 cifre.',
            'piva.max' => 'La partita IVA deve essere composta da 11 cifre.',
            'piva.regex' => 'La partita IVA deve essere composta da 11 cifre numeriche.',
            'address.required' => 'L\'indirizzo è obbligatorio.',
            'address.string' => 'L\'indirizzo deve essere una stringa.',
            'address.max' => 'L\'indirizzo non può superare i 255 caratteri.',
            'image.required' => 'L\'immagine è obbligatoria.',
            'image.image' => 'Il file deve essere un\'immagine.',
            'image.mimes' => 'L\'immagine deve essere un file di tipo: jpeg, png, jpg o gif.',
            'image.max' => 'L\'immagine non può superare i 2048 kilobytes.',
            'visible.boolean' => 'Il campo visibilità deve essere booleano.',
        ];
    }
}
