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
    	return view("home.login", ["title" => "前台登录页面"]);
    }

    // 登录的方法
    public function dologin(Request $request)
    {
    	$res = $request -> except("_token", "code");

    	// dd($res);

    	// 获取当前想要登录的用户的数据库里的密码
    	$rs = Homes::where("username", $res["username"]) -> first();

    	// dd($rs->password);                    
    	//判断密码
        //hash
        if (!Hash::check($request->password, $rs->password)) {
            return redirect("/");
        } else {
            return back()->with('error','用户名或者密码错误');
        }

    	// 获取用户输入的值  与 数据库作比对  如果成功  返回1
    }

    // 注册的页面
    public function register()
    {
    	return view("home/register", ["title" => "用户注册页面"]);
    }

    // 注册的方法
    public function signup(Request $request)
    {
    	// echo false; exit;
    	$res = $request -> except("_token", "code", "confirm_password");


    	// dd($res);
    	//网数据表里面添加数据  hash加密
        $res["password"] = Hash::make($request->password);
        

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
            	Mail::send('home.remind', ['hid'=>$rs,'token'=>$res['token'],'email'=>$res['email'],'username'=>$res['username']], function ($m) use ($res) {


		            $m->from(Config::get("app.email"), '淘点货官方网站');

		            $m->to($res["email"], $res["username"])->subject('注册信息');

		        });

            return view('/home/tixing',['title'=>'新注册用户提醒邮件']);
        }
    }

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

                return redirect('/home/login');
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

    	// 与数据库里的名字做比对 如果存在为真返回1  如果不存在为假返回0
    	$res = Homes::where("username", $hname)->first();

    	if ($res) {
    		echo "0";
    	} else {
    		echo "1";
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
 			echo "0";
    	} else {
    		echo "1";
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
    		echo "0";
    	} else {
    		echo "1";
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
    		echo "1";
    	} else {
    		echo "0";
    	}
    }
}
