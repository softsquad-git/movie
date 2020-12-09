<?php

namespace App\Http\Requests\Likes;

use Illuminate\Foundation\Http\FormRequest;

class LikeRequest extends FormRequest
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
            'resource_id' => 'required|integer',
            'resource_type' => 'required',
            'like' => 'required'
        ];
    }
}
