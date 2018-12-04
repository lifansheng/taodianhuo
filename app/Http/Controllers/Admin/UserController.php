<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UserupdateRequest;
use Hash;
use DB;
use App\Model\Admin\User;
use App\Model\Admin\Role;

class UserController extends Controller
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
        $res = User::orderBy("id","asc")
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


        return view("admin/user/index", [
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
        return view("admin/user/add", [
            "title" => "管理员添加"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
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
        
        //加密 解密
        // $res["password"] = encrypt($request->password);

        // dump($res);exit;

        // 存数据
        try{
            $data = User::create($res);
            if($data){
                return redirect("/admin/user")->with("success", "添加成功");
            }
        }catch(\Exception $e){
            return back()->with("error","添加失败");
        }
        /*$data = User::create($res);

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
        $res = User::find($id);

        return view("admin.user.edit",[
            "title"=>"管理员的修改页面",
            "res"=>$res
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserupdateRequest $request, $id)
    {
        //
        $res = $request->except("_token","pic","_method");

        // dd($res);

        // if($request->hasFile("pic")){
        //     //自定义名字
        //     $name = rand(111,999).time();

        //     //获取后缀
        //     $suffix = $request->file("pic")->getClientOriginalExtension();

        //     $request->file("pic")->move("./uploads",$name.".".$suffix);

        //     $res["pic"] = "/uploads/".$name.".".$suffix;

        // }

        // //数据表修改数据
        // try{

        //     $data = User::where("id", $id)->update($res);
            
        //     if($data){
        //         return redirect("/admin/user")->with("success","修改成功");
        //     }

        // }catch(\Exception $e){

        //     return back()->with("error","修改失败");
        // }$res = $request->except("_token","pic","_method");

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

            $data = User::where("id", $id)->update($res);
            
            if($data){
                return redirect("/admin/user")->with("success","修改成功");
            }

        }catch(\Exception $e){

            return back()->with("error","修改失败");
        }

        // $data = User::where("id", $id)->update($res);
        // if ($data) {
        //     echo "修改成功";
        // } else {
        //     echo "修改失败";
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //删除图片  头像
        //unlink

        try{

            $res = User::destroy($id);
            
            if($res){
                return redirect("/admin/user")->with("success","删除成功");
            }

        }catch(\Exception $e){

            return back()->with("error","删除失败");
        }
    }

        public function ajaxupdate(Request $request)
    {
        //判断空 

        //判断管理员名是否一样

        //判断位数 6~16

        // dd($request);
        // $this->validate($request, [
        //     "username" => "required|regex:/^\w{6,16}$/",
        //     "username"=>"different:username"
        // ],[
        //     "username.required" => "管理员名不能为空",
        //     "username.regex"=>"管理员名格式不正确",
        //     "username.different"=>"修改的管理员名一致"
        // ]);

        $res = [];

        $id = $request->ids;

        $res["username"] = $request->uv;

        //修改数据
        $data = User::where("id",$id)->update($res);

        if($data){

            echo 1;
        } else {

            echo 0;
        }
    }


    // 用户角色的添加
    public function user_role(Request $request)
    {   
        // 根据用户的ID查出用户名
        $id = $request->id;

        $res = User::find($id);
        // dd($res->username);

        // 获取当前用户的角色id
        $info = [];
        foreach($res->roles as $k=>$v){
            $info[] = $v->id;
        }
        // dd($info);

        // 查出所有的角色
        $roles = Role::all();
        // dd($roles);

        return view("admin/user/user_role", [
            "title" => "用户角色的添加页面",
            "res" => $res,
            "roles" => $roles,
            "info"=>$info
        ]);
    }

    // 处理方法
    public function do_user_role(Request $request)
    {
        // 获取管理员ID
        $id = $request->id;

        // 获取role_id
        $res = $request->role_id;

        // dd($res);

        //删除原来的角色
        DB::table('user_role')->where('user_id',$id)->delete();

        $arr = [];
        foreach($res as $k => $v){
            $rs = [];

            $rs['user_id'] = $id;
            $rs['role_id'] = $v;
            
            $arr[] = $rs;
        }
        // dd($arr);

        //往数据表里面插入数据
        $data = DB::table('user_role')->insert($arr);

        if($data){
            return redirect('/admin/user')->with('success','添加成功');
        } else {
            return back() -> with("error", "添加失败");
        }
    }

    public function remind()
    {
        return view("admin/user/remind",["title" => "用户权限提示页面"]);
    }
}
