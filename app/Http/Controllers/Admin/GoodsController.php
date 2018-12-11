<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use  App\Model\Admin\Goods;
use  App\Model\Admin\Cate;
use  App\Model\Admin\Gpic;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $res = Goods::orderBy('id','asc')
            ->where(function($query) use($request){
                //检测关键字
                $gname = $request->input('gname');
               
                //如果商品名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
              
            })
        ->paginate($request->input('num', 10));
        // dump($res);
        return view('admin.goods.index',[
            'title'=>'商品的列表页面',
            'res'=>$res,
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
        $rs = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        orderBy('paths')->
        get();

        foreach($rs as $v){

            $ps = substr_count($v->path,',')-1;
            //拼接  分类名
            // $v->catname = str_repeat('|--',$ps).$v->catname;

            $v->title = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$ps).$v->title;
        }

        return view ('admin.goods.add',[
            'title'=>'商品的添加页面',
            'rs'=>$rs,
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
        //
       // $res = $request->all();
       $res = $request->except('_token','gimg','imgs');
       // dd($res);
       //添加数据到goods表里面
       // $rs = Goods::create($res);
       //主图片的信息
       if($request->hasFile('imgs')){
          //自定义名字
          $name = rand(111,999).time();
          //获取后缀
          $suffix = $request->file('imgs')->getClientOriginalExtension();
          //移动/拼接路径
          $request->file('imgs')->move('./uploads/goods',$name.'.'.$suffix);
          //添加到数组
          $res['imgs'] = '/uploads/goods/'.$name.'.'.$suffix;
        }
        // dd($res);
        try{

            $rs = Goods::create($res);
            
            if($rs){
                redirect('/admin/goods')->with('success','添加成功');
            }

            }catch(\Exception $e){

                return back()->with('error','添加失败');
            }
       // dd($res);
       //模型关联

       $id = $rs->id;

       if($request->hasFile('gimg')){

            $file = $request->file('gimg'); //$_FILES

            $arr = [];
            foreach($file as $k => $v){
              //先定义一个数组
              $ar = [];

              $ar['gid'] = $id;
              //设置名字
              $name = rand(1,99).time();
              //后缀
              $suffix = $v->getClientOriginalExtension();
              //移动
              $v->move('./uploads/goods', $name.'.'.$suffix);

              $ar['gimg'] = '/uploads/goods/'.$name.'.'.$suffix;

              $arr[] = $ar;

              //第二种方式
              // $sd = [];

              // $sd=['gid'=>$id,'gimd'=>'/uploads/'.$name.'.'.$suffix];

              // array_push($arr,$sd);
            }
        }
            // dd($arr);
            //插入数据
            // 一对多

            $data = Goods::find($id);
            try{

            $gs = $data->gis()->createMany($arr);
            // $data = User::create($res);
                
            if($gs){
              return redirect('/admin/goods')->with('success','添加成功');
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
        // echo $id;
        // exit;
        // $res = Gpic::destroy($id);
        // $res = Gpic::where('id',$id)->delete();

        // if($res){
        //     echo 1;
        // }else{
        //     echo 0;
        // }

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
        $rs = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        orderBy('paths')->
        get();

        foreach($rs as $v){

            $ps = substr_count($v->path,',')-1;
            //拼接  分类名
            // $v->catname = str_repeat('|--',$ps).$v->catname;

            $v->title = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$ps).$v->title;
        }

        $res = Goods::find($id);

        $gimgs = Gpic::where('gid',$id)->get();

        return view('admin.goods.edit',[
            'title' => '商品的修改页面',
            'rs'=>$rs,
            'res'=>$res,
            'gimgs'=>$gimgs,
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
        // $rs = Gpic::where('gid',$id)->get();
        //修改主表的信息
        $res = $request->except('_token','_method','gimg','imgs');
        // dd($res);

        // $data = Goods::where('id',$id)->update($res);
        try{
          //主图片的信息-张   
          if($request->hasFile('imgs')){
            //自定义名字
            $name = rand(111,999).time();
            //获取后缀
            $suffix = $request->file('imgs')->getClientOriginalExtension();
            //移动/拼接路径
            $request->file('imgs')->move('./uploads/goods',$name.'.'.$suffix);
            //添加到数组
            $res['imgs'] = '/uploads/goods/'.$name.'.'.$suffix;
          }
        //关联表的图片信息
           if($request->hasFile('gimg')){
            $file = $request->file('gimg'); //*****$_FILES
            $arr = [];
            foreach($file as $k => $v){
              //先定义一个数组
              $ar = [];
              $ar['gid'] = $id;
              //设置名字
              $name = rand(1,99).time();
              //后缀
              $suffix = $v->getClientOriginalExtension();
              //移动
              $v->move('./uploads/goods', $name.'.'.$suffix);
              $ar['gimg'] = '/uploads/goods/'.$name.'.'.$suffix;
              $arr[] = $ar;
              }
              $rs = Gpic::where('gid',$id)->insert($arr);  
            } 
              $data = Goods::where('id',$id)->update($res);
              // dd($data);
              /*if($data){
                return redirect('/admin/goods')->with('success','修改成功');
              }else if($rs){
                return redirect('/admin/goods')->with('success','修改成功');
              }*/
            }catch(\Exception $e){

                return back()->with('error','修改失败');
            }
               return redirect('/admin/goods')->with('success','修改成功');

        // if($data){
        //   return redirect('/admin/goods')->with('success','修改成功');
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
        //删除图片
      // $data = Goods::find($id)->gis()->get();
      try{
      $goods =Goods::find($id);
      //先删父表信息
      $goods->delete();
      //再删子表的信息
      $rs = $goods->gis()->delete();            
          if($rs){
            return redirect('/admin/goods')->with('success','删除成功');
          }
        }catch(\Exception $e){

          return back()->with('error','删除失败');
      }
    }

//修改主图片
    public function xiutu(Request $request){
          $file = $request->file('imgs');
        //判断文件是否有效
        if($file->isValid()){
          //上传文件的后缀名
            $entension = $file->getClientOriginalExtension();
            //修改名字
            $newName = date('YmdHis').mt_rand(1000,9999).'.'.$entension;
            //移动文件
            $path = $file->move('./uploads/goods',$newName);

            $filepath = '/uploads/goods/'.$newName;

            $res['imgs'] = $filepath;
            // DB::table('goods')->where('id',session('uid'))->update($res);
            //返回文件的路径
            return  $filepath;
        }
    }

//双击修改子图片
  public function xiugai(Request $request){
    // echo 1;
    $res = $request->get('gid');
    $ress = Gpic::where('id',$res)->delete();

        if($ress){
            echo 1;
        }else{
            echo 0;
        }
    // echo $res;
  }
}
