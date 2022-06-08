<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class CreateNewsRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:16000'],
            'image' => ['nullable', 'mimes:jpg,jpeg,png,bmp,gif,svg,webp'],
            'is_active' => ['required', 'boolean'],
            'is_new' => ['required', 'boolean'],
            'in_main_page' => ['required', 'boolean']
        ];
    }
}
