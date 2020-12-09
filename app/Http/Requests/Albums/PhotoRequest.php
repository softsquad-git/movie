<?php

namespace App\Http\Requests\Albums;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
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
            'photos' => 'required|array|mimes:jpg,png,jpeg,webp'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'photos.required' => trans('validation.required', ['var' => trans('validation.fields.photos')]),
            'photos.array' => trans('validation.array', ['var' => trans('validation.fields.photos')]),
            'photos.mimes' => trans('validation.mimes', ['var' => trans('validation.fields.photos'), 'val' => 'jpg,png,jpeg,webp'])
        ];
    }
}
