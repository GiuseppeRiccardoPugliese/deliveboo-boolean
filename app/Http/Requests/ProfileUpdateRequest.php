<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'name.string' => 'Il nome deve essere una stringa.',
    //         'name.max' => 'Il nome non può superare i 255 caratteri.',
    //         'email.email' => 'L\'indirizzo email non è valido.',
    //         'email.max' => 'L\'indirizzo email non può superare i 255 caratteri.',
    //         'email.unique' => 'Questo indirizzo email è già stato utilizzato.',
    //     ];
    // }
}
