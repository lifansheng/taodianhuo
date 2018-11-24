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
               
                //如果用户名不为空
                if(!empty($gname)) {
                    $query->where('gname','like','%'.$gname.'%');
                }
              
            })
        ->paginate($request->input('num', 10));
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
       $res = $request->except('_token','gimg');

       //添加数据到goods表里面
       $rs = Goods::create($res);
       // dd($res);
       //模型关联

       $id = $rs->id;
      /* if($request->hasFile('gimg')){
            $file = $request->file('gimg');

            $arr = [];
            foreach($file as $k => $v){
                $ar = [];
                $ar = ['gid'] = $id
                //随机名
                // $name = rand(1111,9999).time();

                $name = rand(1111,9999).time();

                //后缀 
                // $suffix = $v->
                $suffix = $v->getClientOriginalExtension();

                //移动
                $v->move('./uploads', $name.'.'.$suffix);

                $ar['gimg'] = '/uploads/'.$name.'.'.$suffix;

                //一次性插入多条
                $arr[] = $ar;
            }
            dd($arr);

       }*/
       if($request->hasFile('gimg')){

            $file = $request->file('gimg'); //$_FILES

            $arr = [];
            foreach($file as $k => $v){

                $ar = [];

                $ar['gid'] = $id;

                //设置名字
                $name = rand(1,99).time();

                //后缀
                $suffix = $v->getClientOriginalExtension();

                //移动
                $v->move('./uploads', $name.'.'.$suffix);

                $ar['gimg'] = '/uploads/'.$name.'.'.$suffix;

                $arr[] = $ar;

                //这是第二种方式
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
        //
        $res = Gpic::where('id',$id)->delete();

        if($res){
            echo 1;
        }else{
            echo 0;
        }

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
        //
        $res = $request->except('_token','_method','gimg');


        $data = Goods::where('id',$id)->update($res);

        //关联标的信息//关联表
        if($request->hasFile('gimg')){

            $file = $request->file('gimg'); //$_FILES

            $arr = [];
            foreach($file as $k => $v){

                $ar = [];

                $ar['gid'] = $id;

                //设置名字
                $name = rand(1,99).time();

                //后缀
                $suffix = $v->getClientOriginalExtension();

                //移动
                $v->move('./uploads', $name.'.'.$suffix);

                $ar['gimg'] = '/uploads/'.$name.'.'.$suffix;

                $arr[] = $ar;
            }
        }

        $arr = [];
        $rs = Gpic::where('gid',$id)->insert($arr);

         if($rs){

            return redirect('/admin/goods')->with('success','修改成功');
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
    }
}
