<?php

namespace App\Http\Requests\DiscountLimit;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateDiscountLimitRequest extends FormRequest
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
