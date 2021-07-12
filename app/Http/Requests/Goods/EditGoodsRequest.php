<?php

namespace App\Http\Requests\Goods;

use Illuminate\Foundation\Http\FormRequest;

class EditGoodsRequest extends FormRequest
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
            'id' => 'required',
            'goods_name' => 'required',
            'category_id' => 'required',
            'goods_description' => 'required',
            'goods_qty' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => 'The category is required',
            'unit_id.required' => 'The unit is required',
        ];
    }
}
