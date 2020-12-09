<?php

namespace App\Http\Requests\Movies;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
        $data = [
            'title' => 'required|string|min:3',
            'category_id' => 'required|integer',
            'description' => 'nullable',
            'is_comment' => 'required',
            'is_rating' => 'required'
        ];
        if ($this->segment(4) == 'create') {
            $data['file'] = 'required|mimes:mp4';
        }

        return $data;
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
            'category_id.required' => trans('validation.required', ['var' => trans('validation.fields.category_id')]),
            'category_id.integer' => trans('validation.integer', ['var' => trans('validation.fields.category_id')]),
            'is_comment.required' => trans('validation.required', ['var' => trans('validation.field.is_comment')]),
            'is_rating.required' => trans('validation.required', ['var' => trans('validation.fields.is_rating')]),
            'file.required' => trans('validation.required_file'),
            'file.mimes' => trans('validation.mimes', ['val' => 'mp4'])
        ];
    }
}
