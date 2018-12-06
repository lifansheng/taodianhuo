<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Lunbo;
use App\Http\Requests;
use DB;

class LunboController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data = Lunbo::orderBy("id","asc")
            ->where(function($query) use($request){
                //检测关键字
                $title = $request->input("title");
                //如果用户名不为空
                if(!empty($title)) {
                    $query->where("title","like","%".$title."%");
                }
            })
        ->paginate($request->input("num", 3));
        // dd($data);

        // 加载模板
        return view('admin.lunbo.index',[
        	'title'=>'轮播图列表',
        	'data'=>$data,
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
        return view('admin.lunbo.add',['title'=>'轮播图添加']);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取输入的值
        $data = $request ->except('_token','pic');

        //创建轮播图上传对象①
        if($request->hasFile('pic')){
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request->file('pic')->move('./admins/lunboimg',$name.'.'.$suffix);

            $data['pic'] = '/admins/lunboimg/'.$name.'.'.$suffix;
        }

        $data['addtime'] = date('Y-m-d H:i:s',time());

        try{

            $data = Lunbo::create($data);
            
            if($data){
                return redirect('/admin/lunbo')->with('success','添加成功');
            }

        }catch(\Exception $e){

            return back()->with('error','添加失败');
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
        //
        $data = Lunbo::find($id);
        /*dd($data);*/
        //添加修改页面
        return view('admin.lunbo.edit',['title'=>'轮播图修改','data'=>$data]);

    }

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
            $path = $file->move('./admins/lunboimg',$newName);

            $filepath = '/admins/lunboimg/'.$newName;

            //返回文件的路径
            return  $filepath;
        }
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
        //获取输入的值
        $data = $request ->except('_token','pic','_method');
        // dd($data);
        //创建轮播图上传对象①
        if($request->hasFile('pic')){
             //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request->file('pic')->move('./admins/lunboimg',$name.'.'.$suffix);

            $data['pic'] = '/admins/lunboimg/'.$name.'.'.$suffix;
            //执行上传
 
            try{
	           	$res = Lunbo::find($id)->update($data);
	            if($res){
	                return redirect('/admin/lunbo')->with('success','修改成功');
	            }

        	}catch(\Exception $e){

            	return back()->with('error','修改失败');
        	}
        }else{
        	try{
	           	//如果不修改头像 查出数据库原有的图片
            	$da = Lunbo::find($id);
            	$res = Lunbo::find($id)->update(['pic'=>$da['pic'],'title'=>$data['title'],'url'=>$data['url']]);
	            if($res){
	                return redirect('/admin/lunbo')->with('success','修改成功');
	            }

        	}catch(\Exception $e){

            	return back()->with('error','修改失败');
        	}
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
        	//实例化数据表
        	$res =Lunbo::find($id)->delete();
	            if($res){
	                return redirect('/admin/lunbo')->with('success','删除成功');
	            }

    	}catch(\Exception $e){

        	return back()->with('error','删除失败');
    	}
    }
}
