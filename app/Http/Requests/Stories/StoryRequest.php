<?php

namespace App\Http\Requests\Stories;

use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'category_id' => 'required|integer',
            'content' => 'required|string|min:500',
            'is_comment' => 'required',
            'is_rating' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => trans('validation.required', ['var' => trans('validation.fields.title')]),
            'title.string' => trans('validation.string', ['var' => trans('validation.fields.title')]),
            'title.min' => trans('validation.min', ['var' => trans('validation.fields.title'), 'val' => 3]),
            'content.required' => trans('validation.required', ['var' => trans('validation.fields.content')]),
            'content.string' => trans('validation.string', ['var' => trans('validation.fields.content')]),
            'content.min' => trans('validation.min', ['var' => trans('validation.fields.content'), 'val' => 500]),
            'is_comment.required' => trans('validation.required', ['var' => trans('validation.field.is_comment')]),
            'is_rating.required' => trans('validation.required', ['var' => trans('validation.fields.is_rating')]),
        ];
    }
}
