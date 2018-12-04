<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //一个条件的搜索
        $res = Role::where("role_name","like","%".$request->role_name."%")->paginate($request->input("num",10));

        return view("admin/role/index", [
            "title" => "角色管理页面",
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
        return view("admin/role/add", [
            "title" => "角色添加页面"
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
        $rs = $request -> except("_token");
        // dd($rs);
        $rs["created_at"] = date("Y-m-d H:i:s",time());

        // 存数据
        try{
            $res = Role::create($rs);
            if($res){
                return redirect("/admin/role")->with("success", "添加成功");
            }
        }catch(\Exception $e){
            return back()->with("error","添加失败");
        }
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
        // 根据id获取数据
        $res = Role::find($id);

        return view("admin/role/edit", [
            "title" => "角色的修改页面",
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
        $res = $request->except("_token", "_method");
        // dd($res);

        $res["updated_at"] = date("Y-m-d H:i:s", time());

        // 数据表修改数据
        try{

            $data = Role::where("id", $id)->update($res);
            
            if($data){
                return redirect("/admin/role")->with("success","修改成功");
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
        try{

            $res = Role::destroy($id);
            
            if($res){
                return redirect("/admin/role")->with("success","删除成功");
            }

        }catch(\Exception $e){

            return back()->with("error","删除失败");
        }
    }

    // 角色添加权限的页面
    public function role_per(Request $request)
    {
        //获取角色名
        $id = $request->id;
        $res = Role::find($id);
        // dd($res);

        $info = [];
        foreach($res->pers as $k => $v){
            $info[] = $v->id;

        }

        // 查询所有的路径
        $per = Permission::all();
        // dd($per);

        return view("admin/role/role_per",[
            "title" => "角色添加权限的页面",
            "res" => $res,
            "per" => $per,
            "info"=>$info
        ]);
    }

    // 处理角色权限的方法
    public function do_role_per(Request $request)
    {
        // 角色id
        $id = $request ->id;

        // 删除之前已有的
        DB::table('role_permission')->where('role_id',$id)->delete();


        //权限路径id
        $per_id = $request->per_id;
        // dd($per_id, $id);

        $pers = [];
        foreach($per_id as $k => $v){
            $rs = [];
            $rs['role_id'] = $id;
            $rs['per_id'] = $v;
            $pers[] = $rs;
        }

        //插入数据
        $data = DB::table('role_permission')->insert($pers);

        if($data){
            return redirect('admin/role')->with('success','添加成功');
        } else {
            return back() ->with("error", "添加失败");
        }
    }
}
