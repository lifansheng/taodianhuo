<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use DB;
use Hash;

class LoginController extends Controller
{
    // 显示登录页面
    public function login()
    {
    	return view("admin/login", ["title" => "后台登录页面"]);
    }

    // 登录验证
    public function dologin(Request $request)
    {
        //表单验证
    	//判断用户名
        $rs = DB::table('user')->where('username',$request->username)->first();

        // dd($rs);
        
        //判断验证码
        $code = session('code');

        if($code != $request->code){
           
            return back()->with('error','验证码错误');
        }

        if (!$rs) {
            return back()->with("error", "用户名或者密码错误");
        }

        //判断密码
        //hash
        if (!Hash::check($request->password, $rs->password)) {
            
            return back()->with('error','用户名或者密码错误');
        }

        //存点信息  session
        session(['uid'=>$rs->id]);
        session(['uname'=>$rs->username]);

        return redirect('/admin');
    }

    //生成验证码方法
	public function captcha()
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(76, 95, 110);
        $builder->setMaxAngle(15);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 130, $height = 42, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        session(["code" => $phrase]);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    // 修改头像页面
    public function pic()
    {
        return view('admin.pic',['title'=>'修改头像']);
    }

    // 修改头像方法
    public function upload(Request $request)
    {
        //获取上传的文件对象
        $file = $request->file('pic');
        //判断文件是否有效
        if($file->isValid()){
            //上传文件的后缀名
            $entension = $file->getClientOriginalExtension();
            //修改名字
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
            //移动文件
            $path = $file->move('./uploads',$newName);

            $filepath = '/uploads/'.$newName;

            $res['pic'] = $filepath;
            DB::table('user')->where('id',session('uid'))->update($res);
            //返回文件的路径
            return  $filepath;
        }
    }


    //修改密码页面
    public function changepass()
    {
        return view("admin/changepass", ["title" => "修改密码"]);
    }

    //修改页面方法
    public function changenewpass(Request $request)
    {
        $this->validate($request, [
            "password" => "required|regex:/^\S{6,12}$/",
            "repass"=>"same:password",
        ],[
            "password.required"  => "密码不能为空",
            "password.regex"  => "密码格式不正确",
            "repass.same"=>"两次输入密码不一致",
        ]);

        // 获取表单提交的新密码
        $rs = $request -> except("_token", "repass");
        $rss = implode($rs);
        // dump($rss);

        // 与数据库做比对 新密码=原密码 不通过
        // 获取ID
        $res = session("uid");

        // 获取ID所对应的密码
        $pass = DB::table("user")->where("id",$res)->first()->password;
        // dump($pass);   //exit;


        // 新旧密码比对
        if (Hash::check($rss, $pass)) {
            // echo "相同了";
            $this->validate($request, [
                "password"=>"different:password"
            ],[
                "password.different"=>"新密码不能与原密码一致"
            ]);
        }

        // hash 加密
        $rs["password"] = Hash::make($request->password);

        // 存数据
        try{
            $data = DB::table('user')
            ->where("id",$res)
            ->update($rs);

            if($data){
                return redirect("/admin")->with("success", "修改成功");
            }
        }catch(\Exception $e){
            return back()->with("error","修改失败");
        }
    }


    //退出
    public function logout()
    {
        //清空session
        session(['uid'=>'']);

        return redirect('/admin/login');
    }
}
