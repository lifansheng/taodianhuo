<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
            //正则没写完
        // $a ='((https|http|ftp|rtsp|mms){0,1}(:\/\/){0,1})www\.(([A-Za-z0-9-~]+)\.)+([A-Za-z0-9-~\/])+';
        return [

             'lname' => 'required',
             
             'lurl' => 'required',
             'lpic' => 'required'
            //
        ];
    }

    public function messages()
    {
        return [
                 'lname.required' => '链接名称不能为空',              
                  'lpic.required' => '图片不能为空',
                 'lurl.required' => '链接不能为空',
                 'lurl.regex'=>'地址格式不正确'
        ];
    }
}
