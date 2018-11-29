<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Homeuser;
use Hash;

class HomeuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //多个条件的搜索
        $res = Homeuser::orderBy("hid","asc")
            ->where(function($query) use($request){
                //检测关键字
                $username = $request->input("username");
                $email = $request->input("email");
                //如果管理员名不为空
                if(!empty($username)) {
                    $query->where("username","like","%".$username."%");
                }
                //如果邮箱不为空
                if(!empty($email)) {
                    $query->where("email","like","%".$email."%");
                }
            })
        ->paginate($request->input("num", 10));

        return view("admin/homeuser/index", [
            "title" => "管理员列表页面",
            "res" => $res,
            "request" => $request
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("admin/homeuser/add", [
            "title" => "用户添加"
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 获取表单提交结果
        $res = $request -> except("_token", "pic", "repass");
        // dd($res);

        // 头像
        if($request->hasFile("pic")){
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file("pic")->getClientOriginalExtension();

            $request->file("pic")->move("./uploads",$name.".".$suffix);

            $res["pic"] = "/uploads/".$name.".".$suffix;
        }

        //网数据表里面添加数据  hash加密
        $res["password"] = Hash::make($request->password);
        // dd($res);

        // 存数据
        try{
            $data = Homeuser::create($res);
            if($data){
                return redirect("/admin/homeuser")->with("success", "添加成功");
            }
        }catch(\Exception $e){
            return back()->with("error","添加失败");
        }

        /*$data = Homeuser::create($res);

        if ($data) {
            echo "添加成功";
        } else {
            echo "添加失败";
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        // 根据id获取数据
        $res = Homeuser::find($id);
        return view("admin/homeuser/edit", [
            "title" => "用户的修改页面",
            "res" => $res
         ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // 获取用户提交的数据
        $res = $request->except("_token","pic","_method");
        // dd($res);

        // 修改头像
        if($request->hasFile("pic")){
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file("pic")->getClientOriginalExtension();

            $request->file("pic")->move("./uploads",$name.".".$suffix);

            $res["pic"] = "/uploads/".$name.".".$suffix;

        }

        // 数据表修改数据
        try{

            $data = Homeuser::where("hid", $id)->update($res);
            
            if($data){
                return redirect("/admin/homeuser")->with("success","修改成功");
            }

        }catch(\Exception $e){

            return back()->with("error","修改失败");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo 1; exit;
        // 删除
        try{

            $res = Homeuser::destroy($id);
            
            if($res){
                return redirect("/admin/homeuser")->with("success","删除成功");
            }

        }catch(\Exception $e){

            return back()->with("error","删除失败");
        }
    }

    // ajax
    // 用户名
    public function ajaxhomeusername(Request $request)
    {
        // 获取用户输入的用户名
        $hname = $request -> get("hname");   

        // 与数据库里的名字做比对 如果存在为真返回0  如果不存在为假返回1
        $res = Homeuser::where("username", $hname)->first();

        if ($res) {
            echo "0";
        } else {
            echo "1";
        }
    }

    // 手机号码
    public function ajaxhomephone(Request $request)
    {
        // 获取用户输入的手机号码
        $phone = $request -> get("phone");   

        // 与数据库里的名字做比对 如果存在为真返回0  如果不存在为假返回1
        $res = Homeuser::where("phone_number", $phone)->first();

        if ($res) {
            echo "0";
        } else {
            echo "1";
        }
    }

    // email
    public function ajaxhomeemail(Request $request)
    {
        // 获取用户输入的手机号码
        $email = $request -> get("email");   

        // 与数据库里的名字做比对 如果存在为真返回0  如果不存在为假返回1
        $res = Homeuser::where("email", $email)->first();

        if ($res) {
            echo "0";
        } else {
            echo "1";
        }
    }

    public function homeuserajax(Request $request)
    {
        $res = [];
        // var_dump($res); exit;

        $id = $request->ids;

        $res["username"] = $request->uv;

        //修改数据
        $data = Homeuser::where("hid",$id)->update($res);

        if($data){

            echo 1;
        } else {

            echo 0;
        }
    }
}
