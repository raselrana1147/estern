<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockRequest extends FormRequest
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
            'stock_category_id' => 'required',
            'stock_brand_id' => 'required',
            'stock_model_id' => 'required',
            'branch_office_id' => 'required',
            'quality' => 'required',
            'color' => 'required',
            'variation' => 'required',
            'quantity' => 'required',
            'purchase_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'whole_sale_price' => 'required|numeric',
        ];
    }
}
