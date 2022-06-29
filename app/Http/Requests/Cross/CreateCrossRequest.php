<?php

namespace App\Http\Requests\Cross;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateCrossRequest extends FormRequest
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
            'main_brand' => ['required', 'string', 'max:255'],
            'main_article' => ['required', 'string', 'max:255'],
            'repl_brand' => ['required', 'string', 'max:255'],
            'repl_article' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'quality' => ['required', 'numeric', 'max:5', 'min:1'],
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        return $request;
    }
}
