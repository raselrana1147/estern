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
            'category_id' => 'required',
            'brand_id' => 'required',
            'model' => 'required',
            'code' => 'required',
            'name' => 'required',
            'title' => 'required',
            'image' => 'required',
            'price' => 'required',
            'previous_price' => 'required',
            'discount'=>'nullable',
            'price' => 'required',
            'quantity' => 'required',
            'color' => 'required',
            'warranty' => 'required',
        ];
    }
}
