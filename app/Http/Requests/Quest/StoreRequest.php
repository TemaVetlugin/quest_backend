<?php

namespace App\Http\Requests\Quest;

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
            'title'=> 'required|string',
            'purpose'=> 'string',
            'time'=> 'string',
            'length'=> 'string',
            'description'=> 'string',
            'start_info'=> 'string',
            'final'=>'string',
        ];
    }
}
