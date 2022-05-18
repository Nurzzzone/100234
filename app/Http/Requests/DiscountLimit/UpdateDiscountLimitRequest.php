<?php

namespace App\Http\Requests\DiscountLimit;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountLimitRequest extends FormRequest
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
        //TODO переделать
        return [
            'manufacturer' => ['required', 'string'],
            'limit_2' => ['required', ],
            'limit_10' => ['required', ],
            'limit_11' => ['required', ],
            'limit_12' => ['required', ],
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
