<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.required' => trans('validation.required', ['var' => trans('validation.fields.email')]),
            'email.email' => trans('validation.email'),
            'password.required' => trans('validation.required', ['var' => trans('validation.fields.password')]),
            'password.string' => trans('validation.string', ['var' => trans('validation.fields.password')]),
            'password.min' => trans('validation.min', ['var' => trans('validation.fields.password'), 'val' => 8])
        ];
    }
}
