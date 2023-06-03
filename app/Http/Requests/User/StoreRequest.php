<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|string',
            'email'=> 'required|string',
            'password'=> 'required|string|confirmed',
            'scores'=>'integer',
        ];

    }
    public function messages(): array
    {
        return [
            'password.confirmed' => 'Пароли не совпадают',
        ];
    }
}
