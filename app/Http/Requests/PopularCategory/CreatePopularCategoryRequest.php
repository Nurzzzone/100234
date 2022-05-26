<?php

namespace App\Http\Requests\PopularCategory;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreatePopularCategoryRequest extends FormRequest
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
            'hierarchy_id' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
            'description' => ['nullable', 'string', 'max:100'],
        ];
    }
}
