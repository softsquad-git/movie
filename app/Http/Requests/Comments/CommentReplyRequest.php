<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CommentReplyRequest extends FormRequest
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
            'content' => 'required|min:2',
            'resource_id' => 'required|integer',
            'resource_type' => 'required'
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'content.required' => trans('validation.required', ['var' => trans('validation.fields.comment_reply')]),
            'content.min' => trans('validation.min', ['var' => trans('validation.field.comment_reply'), 'min' => 2])
        ];
    }
}
