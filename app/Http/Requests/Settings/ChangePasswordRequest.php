<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'old_password.required' => trans('validation.required', ['var' => trans('validation.fields.old_password')]),
            'old_password.string' => trans('validation.string', ['var' => trans('validation.fields.old_password')]),
            'old_password.min' => trans('validation.min', ['var' => trans('validation.fields.old_password'), 'val' => 8]),
            'new_password.required' => trans('validation.required', ['var' => trans('validation.fields.new_password')]),
            'new_password.string' => trans('validation.string', ['var' => trans('validation.fields.new_password')]),
            'new_password.min' => trans('validation.min', ['var' => trans('validation.fields.new_password'), 'val' => 8]),
        ];
    }
}
