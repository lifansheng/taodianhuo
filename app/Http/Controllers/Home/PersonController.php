<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
use App\Model\Home\Homes;

class PersonController extends Controller
{
    //
    public function pindex(){
$res = session('hid');
                // dd($res);
                $data = DB::table('homes')->where('hid',$res)->first();
    	return view('home.person.sy',['data' => $data]);
    }


    public function index(){
    			$res = session('hid');
    			// dd($res);
    			$data = DB::table('homes')->where('hid',$res)->first();
// dd($data);
    	return view('home.person.information',['data'=>$data]);
    }



      public function update(Request $request, $id)
    {

        $res =$request ->except('_token','pic','_method');
      
        if($request->hasFile('pic')) {
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request ->file('pic')->move('./uploads', $name.'.'.$suffix);

            $res['pic'] ='/uploads/'.$name.'.'.$suffix;

           
            # code...
        }


        try{

            $data = DB::table('homes') ->where('hid',session('hid'))->update($res);
                
           
                // dd($data);
        }catch(\Exception $e){

            return back()->with('error','修改失败');
        }         
        
                return redirect('/home/personinformation')->with('success', '修改成功');
        // 
        
    }

    public function safety()
    {
        return view("home/person/safety", [
            "title"=>"安全设置"
        ]);
    }

    // 修改密码页面
    public function psword()
    {
        return view("home/person/psword", [
            "title"=>"修改密码"
        ]);
    }

    // 修改密码方法
    public function dopsword(Request $request)
    {
        $res = $request -> only("password");
        // dd($res["password"]);

        // hash加密
        $res["password"] = Hash::make($request->password);
        // dd($res);

        // 存入数据库
        try{
            $data = Homes::where("hid", session("hid"))->update($res);
            if($data){
                return redirect("/home/login/login")->with("success", "修改成功，安全起见，请您重新登录");
            }
        }catch(\Exception $e){
            return back()->with("error","修改失败");
        }

    }

    // ajax验证密码是否正确
    public function ajaxuop(Request $request)
    {
        // 获取用户输入的密码
        $res = $request->get("uop");

        // 取出当前登录的用户的原密码
        $data = Homes::where("hid", session("hid"))->value("password");

        // hash解密
        if (!Hash::check($res, $data)) {
            echo 0;           
        } else {
            echo 1;
        }   
    }

    // 绑定手机页面
    public function bindphone()
    {
        return view("home/person/bindphone", [
            "title"=>"修改绑定手机"
        ]);
    }

    // 绑定手机的方法
    public function dobindphone(Request $request)
    {
        // 获取用户新绑定的手机号码
        $res = $request -> only("phone_number");
        // dd($res["phone_number"]);

        // 存入数据库
        try{
            $data = Homes::where("hid", session("hid"))->update($res);
            if($data){
                return redirect("/home/login/login")->with("success", "修改成功，请以新绑定的号码重新登录");
            }
        }catch(\Exception $e){
            return back()->with("error","修改失败");
        }


    }

    // ajax 解绑手机号码
    public function ajaxbindphone(Request $request)
    {
        // 获取手机号码
        $Number = $request -> get("number");

        //初始化必填
        $options['accountsid']='a0477649bdaaa0d7a7a94ec91fc9a490';
        $options['token']='43fbcb4f69bfbd0561ce625a1d5b4682';

        //初始化 $options必填
        $ucpass = new \Ucpaas($options);

        //开发者账号信息查询默认为json或xml
        // $ucpass->getDevinfo('xml');

        // 验证码
        $codes = rand(111111,999999);
        $request->session()->put('bindphonecode', $codes);
        $request->session()->save();
        // $cc = $request->session()->get('bindphonecode');
        // echo $cc;
        // session("codess",$codes);
        // var_dump(session('codess'));
        // echo session("codess");

        $appId = "2e85c67bef98453eae0c3b0913f40127";
        $templateId = "408468";

        $ucpass->templateSMS($appId,$Number,$templateId,$codes);
    }

    // 解绑验证码
    public function ajaxbindphonecode(Request $request)
    {
        // 获取用户输入的解绑验证码
        $rs = $request -> get("code");
        // echo $request->session()->get('bindphonecode');
        // echo session("bindphonecode");
        // 与解绑手机收到的验证码做比对
        if ($rs == $request->session()->get('bindphonecode')){
            echo 1;
        } else {
            echo 0;
        }
    }

    // 新绑定手机号码
    public function ajaxbindphones(Request $request)
    {
        // 获取手机号码
        $Number = $request -> get("number");
        // echo $Number;

        //初始化必填
        $options['accountsid']='a0477649bdaaa0d7a7a94ec91fc9a490';
        $options['token']='43fbcb4f69bfbd0561ce625a1d5b4682';

        //初始化 $options必填
        $ucpass = new \Ucpaas($options);

        //开发者账号信息查询默认为json或xml
        // $ucpass->getDevinfo('xml');

        // 验证码
        $codes = rand(111111,999999);
        $request->session()->put('bindphonecodes', $codes);
        $request->session()->save();
        // $cc = $request->session()->get('bindphonecodes');
        // echo $cc;
        // session("codess",$codes);
        // var_dump(session('codess'));
        // echo session("codess");

        $appId = "2e85c67bef98453eae0c3b0913f40127";
        $templateId = "408468";

        $ucpass->templateSMS($appId,$Number,$templateId,$codes);
    }

    // 解绑验证码
    public function ajaxbindphonecodes(Request $request)
    {
        // 获取用户输入的解绑验证码
        $rs = $request -> get("code");
        // echo $request->session()->get('bindphonecodes');
        // echo session("bindphonecode");
        // 与解绑手机收到的验证码做比对
        if ($rs == $request->session()->get('bindphonecodes')){
            echo 1;
        } else {
            echo 0;
        }
    }
}
