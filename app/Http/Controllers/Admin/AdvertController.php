<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Advert;
use DB;



class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //一个条件的搜索
        $res = Advert::where('title','like','%'.$request->title.'%')->paginate($request->input('num',10));
        return view("admin/advert/index", [
            "title" => "广告列表页面",
            "res" => $res,
            'request'=>$request
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
        return view("admin/advert/add", [
            "title" => "广告添加页面"
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
        // 接受数据
        $res = $request -> except("_token", "pic");
        // dd($res);

        // $res['addtime'] = time();
        $res['addtime'] = date("Y-m-d H:i:s",time());

        // 图片
        if($request->hasFile("pic")){
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file("pic")->getClientOriginalExtension();

            $request->file("pic")->move("./uploads",$name.".".$suffix);

            $res["pic"] = "/uploads/".$name.".".$suffix;

        }
        // dd($res);

        // 存数据
        try{
            $data = Advert::create($res);
            if($data){
                return redirect("/admin/advert")->with("success", "添加成功");
            }
        }catch(\Exception $e){
            return back()->with("error","添加失败");
        }

            // $data = Advert::create($res);
            // if ($data) {
            //     echo 1;
            // }  else {
            //     echo 0;
            // }
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
        $res = Advert::find($id);
        return view("admin/advert/edit", [
            "title" => "广告修改页面",
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
        //
        $res = $request->except("_token","pic","_method");
        // dd($res);

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

            $data = Advert::where("id", $id)->update($res);
            
            if($data){
                return redirect("/admin/advert")->with("success","修改成功");
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
        //
        try{

            $res = Advert::destroy($id);
            
            if($res){
                return redirect("/admin/advert")->with("success","删除成功");
            }

        }catch(\Exception $e){

            return back()->with("error","删除失败");
        }
    }

    public function ajaxupdate(Request $request)
    {
        $res = [];

        $id = $request->ids;

        $res["title"] = $request->uv;

        //修改数据
        $data = Advert::where("id",$id)->update($res);
        // dump($data);

        if($data){

            echo 1;
        } else {

            echo 0;
        }
    }
}
