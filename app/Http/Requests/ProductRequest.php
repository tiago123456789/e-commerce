<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "description" => "required|max:65",
            "price" => "required|min:1",
            "width" => "required|min:1",
            "height" => "required|min:1",
            "length" => "required|min:1",
            "weight" => "required|min:1",
            "image" => "required|image|max:2048",
        ];
    }
}
