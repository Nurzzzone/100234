<?php

namespace App\Http\Requests\News;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'             => ['nullable', 'string', 'max:255'],
            'description'       => ['nullable', 'string', 'max:255'],
            'content'           => ['nullable', 'string', 'max:16000'],
            'image'             => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'previous_image'    => ['nullable', 'string'],
            'is_active'         => ['nullable', 'boolean'],
            'is_new'            => ['nullable', 'boolean'],
            'in_main_page'      => ['nullable', 'boolean']
        ];
    }
}
