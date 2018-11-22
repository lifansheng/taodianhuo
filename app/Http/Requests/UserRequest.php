<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "username" => "required|regex:/^\w{6,16}$/",
            "password" => "required|regex:/^\S{6,12}$/",
            "repass"=>"same:password",
            // "age" => "required|regex:/^1[8-9]|[2-5]\d|80$/",
            "tel"=>"regex:/^1[3456789]\d{9}$/",
            "email"=>"email",
            "pic"=>"required"
        ];
    }

    /**
     * 获取已定义验证规则的错误消息。
     *
     * @return array
     */
    public function messages()
    {
        return [
            "username.required" => "用户名不能为空",
            "username.regex"=>"用户名格式不正确",
            "password.required"  => "密码不能为空",
            "password.regex"  => "密码格式不正确",
            "repass.same"=>"两次密码不一致",
            // "age.required" => "年龄不能为空",
            // "age.regex" => "年龄不能小于18",
            "tel.regex"=>"手机号码格式不正确",
            "email.email"=>"邮箱格式不正确",
            "pic.required"=>"请上传图片"
        ];
    }
}
