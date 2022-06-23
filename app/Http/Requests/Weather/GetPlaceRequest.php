<?php

namespace App\Http\Requests\Weather;

use Illuminate\Foundation\Http\FormRequest;

class GetPlaceRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'lat' => 'required',
            'lon' => 'required'
        ];
    }
}
