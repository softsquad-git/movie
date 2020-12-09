<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'username' => 'nullable|string|min:4|unique:users',
            'birthday' => 'required|date_format:Y-m-d',
            'sex' => 'required|integer',
            'info.country' => 'nullable|string|min:3',
            'info.city' => 'nullable|string|min:3',
            'info.post_code' => 'nullable|string|min:6',
            'info.address' => 'nullable|string|min:3',
            'info.contact_phone' => 'nullable|string|min:9'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => trans('validation.required', ['var' => trans('validation.fields.name')]),
            'name.string' => trans('validation.string', ['var' => trans('validation.fields.name')]),
            'name.min' => trans('validation.min', ['var' => trans('validation.fields.name'), 'val' => 3]),
            'last_name.required' => trans('validation.required', ['var' => trans('validation.fields.last_name')]),
            'last_name.string' => trans('validation.string', ['var' => trans('validation.fields.last_name')]),
            'last_name.min' => trans('validation.min', ['var' => trans('validation.fields.last_name'), 'val' => 3]),
            'email.required' => trans('validation.required', ['var' => trans('validation.fields.email')]),
            'email.email' => trans('validation.email'),
            'password.required' => trans('validation.required', ['var' => trans('validation.fields.password')]),
            'password.string' => trans('validation.string', ['var' => trans('validation.fields.password')]),
            'password.min' => trans('validation.min', ['var' => trans('validation.fields.password'), 'val' => 8]),
            'username.string' => trans('validation.string', ['var' => trans('validation.fields.username')]),
            'username.min' => trans('validation.min', ['var' => trans('validation.fields.username'), 'val' => 4]),
            'username.unique' => trans('validation.unique.username'),
            'birthday.required' => trans('validation.required', ['var' => trans('validation.fields.birthday')]),
            'birthday.date_format' => trans('validation.date_format'),
            'sex.required' => trans('validation.required', ['var' => trans('validation.fields.sex')]),
            'sex.integer' => trans('validation.integer', ['var' => trans('validation.fields.sex')]),
            'info.country.string' => trans('validation.string', ['var' => trans('validation.fields.country')]),
            'info.country.min' => trans('validation.min', ['var' => trans('validation.fields.country'), 'val' => 3]),
            'info.city.string' => trans('validation.string', ['var' => trans('validation.fields.city')]),
            'info.city.min' => trans('validation.min', ['var' => trans('validation.fields.city'), 'val' => 3]),
            'info.address.string' => trans('validation.string', ['var' => trans('validation.fields.address')]),
            'info.address.min' => trans('validation.min', ['var' => trans('validation.fields.address'), 'val' => 3]),
            'info.contact_phone.required' => trans('validation.required', ['var' => trans('validation.fields.contact_phone')]),
            'info.contact_phone.min' => trans('validation.min', ['var' => trans('validation.fields.contact_phone'), 'val' => 9])
        ];
    }
}
