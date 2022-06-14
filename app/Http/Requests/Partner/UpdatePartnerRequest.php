<?php

namespace App\Http\Requests\Partner;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'is_confirmed_by_manager' => ['sometimes', 'boolean', 'max:255'],
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
