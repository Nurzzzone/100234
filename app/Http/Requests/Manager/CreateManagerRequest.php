<?php

namespace App\Http\Requests\Manager;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class CreateManagerRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();

        if ($this->has('name')) {
            $request['slug'] = Str::slug($this->name);
        }
        
        return $request;
    }
}
