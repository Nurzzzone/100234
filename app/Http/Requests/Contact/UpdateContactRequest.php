<?php

namespace App\Http\Requests\Contact;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'latitude' => ['required', 'string'],
            'longitude' => ['required', 'string'],
            'phones.*' => ['required'],
            'schedules.*' => ['required'],
        ];
    }
}
