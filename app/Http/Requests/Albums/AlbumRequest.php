<?php

namespace App\Http\Requests\Albums;

use Illuminate\Foundation\Http\FormRequest;

class AlbumRequest extends FormRequest
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
            'is_private' => 'required',
            'is_visibility' => 'required'
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
            'is_private.required' => trans('validation.required', ['var' => trans('validation.fields.is_private')]),
            'is_visibility.required' => trans('validation.required', ['var' => trans('validation.fields.is_visibility')])
        ];
    }
}
