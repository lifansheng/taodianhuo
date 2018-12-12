<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoodsRequest extends FormRequest
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
            //
            "gname" => "required",
            "imgs"=>"required",
            "price"=>"required",
            "color"=>"required",
            "size"=>"required",

        ];
    }

    // public function messages()
    public function messages()
    {
        return [
            "gname.required" => "商品名不能为空",
            "imgs.required"=>"商品主图片不能为空",
            "price.required"=>"价格不能为空",
            "color.required"=>"口味不能为空",
            "size.required"=>"规格不能为空",

        ];
    }
}
