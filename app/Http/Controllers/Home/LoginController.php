<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use DB;
use Hash;
use Mail;
use Config;
use App\Model\Home\Homes;

class LoginController extends Controller
{
    // 显示登录页面
    public function login()
    {
    	return view("home/login/login", ["title" => "前台登录页面"]);
    }

    // 登录的方法
    public function dologin(Request $request)
    {
        // echo 1; exit;
        // 获取用户提交的数据
    	$res = $request -> except("_token", "code");
        // dd($res["username"]);
    
        $usernames = Homes::where("username", $res["username"])->first();
        $emails = Homes::where("email", $res["username"])->first();
        $phones = Homes::where("phone_number", $res["username"])->first();
        // dd($phones);
        if (!($usernames || $emails || $phones)) {
            return back()->with("error", "用户名或者密码错误");
        } else if ($usernames) {
            //判断密码 hash
            if (!Hash::check($request->password, $usernames->password)) {
                return back()->with('error','用户名或者密码错误');           
            } else {  
                // 判断状态
                if (!$usernames->status == "1") {
                    return back()->with('error','您尚未激活账号'); 
                }
                // session 存入登录的ID和用户名信息
                session([
                    'hid'=>$usernames->hid,
                    'huname'=>$usernames->username,
                    'phone_number'=>$usernames->phone_number
                ]);
                return redirect("/");  
            }
        } else if ($emails) {
            //判断密码 hash
            if (!Hash::check($request->password, $emails->password)) {
                return back()->with('error','用户名或者密码错误');           
            } else {  
                // 判断状态
                if (!$emails->status == "1") {
                    return back()->with('error','您尚未激活账号'); 
                }
                // session 存入登录的ID和用户名信息
                session([
                    'hid'=>$emails->hid,
                    'huname'=>$emails->username,
                    'phone_number'=>$emails->phone_number
                ]);
                return redirect("/");  
            }
        } else if ($phones) {
            //判断密码 hash
            if (!Hash::check($request->password, $phones->password)) {
                return back()->with('error','用户名或者密码错误');           
            } else {  
                // 判断状态
                if (!$phones->status == "1") {
                    return back()->with('error','您尚未激活账号'); 
                }
                // session 存入登录的ID和用户名信息
                session([
                    'hid'=>$phones->hid,
                    'huname'=>$phones->username,
                    'phone_number'=>$phones->phone_number
                ]);
                return redirect("/");  
            }
        }     
    }

    // 注册的页面
    public function register()
    {
    	return view("home/login/register", ["title" => "用户注册页面"]);
    }

    // 注册的方法
    public function signup(Request $request)
    {
    	// echo 1; exit;
    	$res = $request -> except("_token", "code", "confirm_password");


    	// dd($res);
    	//网数据表里面添加数据  hash加密
        $res["password"] = Hash::make($request->password);
        // dd($res);
        

    	// 存数据
		// $data = Homes::create($res);
		// 获取当前用户的id
    	// $ids = Homes::where("username", $res["username"])->value("hid");
        $rs = DB::table('homes')->insertGetId($res);
        // dd($rs);
        $res['token'] = str_random(40);
        session(["token"=>$res["token"]]);
        if($rs){
    	// 发送邮件
        	Mail::send('home.login.remind', ['hid'=>$rs,'token'=>$res['token'],'email'=>$res['email'],'username'=>$res['username']], function ($m) use ($res) {


                $m->from(Config::get("app.email"), '淘点货官方网站');

                $m->to($res["email"], $res["username"])->subject('注册信息');

            });

            return view('/home/login/tixing',['title'=>'新注册用户提醒邮件']);
        }
    }

    // 邮件的提醒方法
    public function tixing(Request $request)
    {
        //获取信息

        //把status 0 => 1
        $id = $request->id;

        $rs = DB::table('homes')->where('hid',$id)->first();

        $token = $request->token;
        // dd(session("token"));

        if(session("token") == $token){

            $res['status'] = "1";

            $data = DB::table('homes')->where('hid',$id)->update($res);

            if($data){

                return redirect('/home/login/login');
            }
        }
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
        $builder->setBackgroundColor(118, 214, 243);
        $builder->setMaxAngle(15);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 160, $height = 50, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        // 把内容存入session
        session(["code" => $phrase]);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    // ajax验证注册名是否重名的方法
    public function ajaxhname(Request $request)
    {
    	// 获取用户输入的用户名
    	$hname = $request -> get("hname");		// var_dump($hname); exit;

    	// 与数据库里的名字做比对 如果存在为真返回0  如果不存在为假返回1
    	$res = Homes::where("username", $hname)->first();

    	if ($res) {
    		echo 0;
    	} else {
    		echo 1;
    	}
    }

    // 检验邮箱
    public function ajaxemail(Request $resquest)
    {
    	// $a = DB::table("homes")->where("username","tdh123")->value("email");

    	// echo $a; exit;
    	// 获取用户输入的邮箱
    	// $ss = $request -> get("emails");			
        $emails = $_POST["emails"];     // var_dump($ss); exit;
        

    	// 与数据库里的名字做比对 如果存在为真返回0 如果不存在为假返回1
    	$res = Homes::where("email", $emails)->first();

    	if ($res) {
 			echo 0;
    	} else {
    		echo 1;
    	}
    }

    // ajax验证是手机号码的方法
    public function ajaxphone(Request $request)
    {
    	// 获取用户输入的手机号
    	$phone = $request -> get("phone");	 // var_dump($phone); exit;

    	// 与数据库里的手机号做比对 如果存在为真返回1  如果不存在为假返回0
    	$res = Homes::where("phone_number", $phone)->first(); // var_dump($res); exit;

    	if ($res) {
    		echo 0;
    	} else {
    		echo 1;
    	}
    }

    // ajax验证验证码的方法
    public function ajaxcode(Request $request)
    {
    	// 获取用户输入的验证码
    	$codes = $request -> get("code");  // var_dump($codes); exit;

    	// 获取session里存的code值
    	$codess = session("code"); // var_dump($codess); exit;

    	// 作比对
    	if ($codes == $codess) {
    		echo 1;
    	} else {
    		echo 0;
    	}
    }


    public function ajaxcontrastname(Request $request)
    {
        // 获取用户所输入的用户名
        $username = $request -> get("username");

        // 与数据库里的用户名做比对
        $usernames = Homes::where("username", $username)->first(); 
        $emails = Homes::where("email", $username)->first(); 
        $phones = Homes::where("phone_number", $username)->first(); 
        

        if (!($usernames || $emails || $phones)) {
            echo 0;
        } else {
            echo 1;
        }
    }

    public function ajaxcontrastphone(Request $request)
    {
        // 获取用户所输入的手机号
        $phone = $request -> get("phone_number");

        // 与数据库里的用户名做比对
        $res = Homes::where("phone_number", $phone)->first();
        dd($res); 

        if (!$res) {
            echo 0;
        } else {
            echo 1;
        }
    }
    

    // public function ajaxcontrast(Request $request)
    // {
    //     // 获取用户所输入的用户名和密码
    //     $username = $request -> get("username");
    //     $password = $request -> get("password");

    //     // 与数据库里的用户名和密码做比对
    //     $res = Homes::where("username", $username)->first(); 


    //     if (!$res) {
    //         // 为假没有这个人
    //         echo "没这个人";
    //         // return ;
    //         // return back() -> with('error', '0');
    //     } else {
    //         // 为真查这个人的密码 与用户所输入的密码作比对 
    //         $rs = Homes::where("username", $username)->value("password");

    //         //hash
    //         if (!Hash::check($password, $rs)) {                 
    //             echo "有这个人但是密码不对";
    //             // return back(); 
    //         } else {  
    //             // session 存入登录的ID和用户名信息
    //             session([
    //                 'hid'=>$res->hid,
    //                 'huname'=>$res->username
    //             ]);          
    //             echo "都对了";  
    //             return redirect("/");          
    //         }
    //     }

        // $res = $request -> except("_token", "code");

        // // dd($res);

        // // 获取当前想要登录的用户的数据库里的密码
        // $rs = Homes::where("username", $res["username"]) -> first();

        

        // // dd($rs->password);                    
        // //判断密码
        // //hash
        // if (!Hash::check($request->password, $rs->password)) {
        //     return back()->with('error','用户名或者密码错误');            
        // } else {            
        //     return redirect("/");            
        // }

        // session 存入登录的ID和用户名信息
        // session([
        //     'hid'=>$res->hid,
        //     'huname'=>$res->username
        // ]);
    // }
    
    //退出
    public function logout()
    {
        //清空session
        session(['hid'=>'']);

        return redirect('/');
    }

    // 忘记密码
    public function forget_password()
    {
        return view("home/login/forget_password", ["title" => "密码找回页面"]);
    }

    public function do_fp(Request $request)
    {
        // 获取用户提交的数据
        $res = $request -> only("phone_number");
        // dd($res);

        return view("home/login/reset_password",[
            "title" => "密码重置页面",
            "res" => $res
        ]);    
    }

    // 重置密码
    public function do_rp(Request $request)
    {
        // 获取用户提交的数据
        $res = $request -> only("password", "phone_number");   
        // dd($res);

        //网数据表里面添加数据  hash加密
        $res["password"] = Hash::make($request->password);
        // dd($res["password"]);

        // 修改数据
        $data = Homes::where("phone_number", $res["phone_number"])->update(["password"=>$res["password"]]);
        
        if (!$data) {
            return back() -> with("error", "修改失败");
        } else {
            return redirect("/home/login/login")->with("success", "修改成功,请登录");
        }
    }

    // 短信验证码
    public function ajaxpcode(Request $request)
    {
        $Number = $request -> get("number");
        $rs = $request -> get("codes");

        //初始化必填
        $options['accountsid']='a0477649bdaaa0d7a7a94ec91fc9a490';
        $options['token']='43fbcb4f69bfbd0561ce625a1d5b4682';

        //初始化 $options必填
        $ucpass = new \Ucpaas($options);

        //开发者账号信息查询默认为json或xml
        // $ucpass->getDevinfo('xml');

        // 验证码
        $codes = rand(111111,999999);
        $request->session()->put('codess', $codes);
        $request->session()->save();
        // $cc = $request->session()->get('codess');
        // echo $cc;
        // session("codess",$codes);
        // var_dump(session('codess'));
        // echo session("codess");

        $appId = "2e85c67bef98453eae0c3b0913f40127";
        $templateId = "406176";

        $ucpass->templateSMS($appId,$Number,$templateId,$codes);
    }

    public function ajaxpcodes(Request $request)
    {
        $rs = $request -> get("codes");
        // echo $request->session()->get('codess');
        // echo session("codess");
        if ($rs == $request->session()->get('codess')){
            echo 1;
        } else {
            echo 0;
        }
    }
}
