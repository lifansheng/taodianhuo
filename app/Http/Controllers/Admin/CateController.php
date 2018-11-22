<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use DB;


class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //获取数据库里的数据
        $res = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        where('title','like','%'.$request->title.'%')->
        orderBy('paths')->paginate($request->input('num',10));



        // $rs = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        // orderBy('paths')->
        // get();
         foreach($res as $v){
            //path  
            //通过逗号来获取前头有几个空格
            $ps = substr_count($v->path,',')-1;
            //拼接  分类名
            // $v->catname = str_repeat('--',$ps).$v->catname;
            //------------重复几次-------重复的东西------------次数---后面的值
            $v->title = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$ps).$v->title;
        }


        //显示页面
        return view('admin.cate.index',[
            'title'=>'分类浏览',
            'res'=>$res,
            'request'=>$request,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询cate表里的数据
        // $rs = Cate::all();
        $rs = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        orderBy('paths')->
        get();
         foreach($rs as $v){
            //path  
            //通过逗号来获取前头有几个空格
            $ps = substr_count($v->path,',')-1;
            //拼接  分类名
            // $v->catname = str_repeat('--',$ps).$v->catname;
            //------------重复几次-------重复的东西------------次数---后面的值
            $v->title = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$ps).$v->title;
        }

        //给分类添加页面
        return view('admin.cate.add',[
            'title'=>'分类添加页面',
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
        //除了_token不要其他的数据都要
        $res = $request->except('_token');
        // dd($res);
       
        if($request->pid == '0'){

            $res['path'] = '0,';

        }else{

            //查询数据
            $rs = DB::table('cate')->where('id',$request->pid)->first();
            // $res['path'] = '';
             // 拼接path的值  path.id       0, 1,
            $res['path'] = $rs->path.$rs->id.',';

        }
        
        try{

        $data = Cate::create($res);
            
            if($data){
                return redirect('/admin/cate')->with('success','添加成功');
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

         $rs = Cate::select(DB::raw('*,CONCAT(path,id) as paths'))->
        orderBy('paths')->
        get();
         foreach($rs as $v){
            //path  
            //通过逗号来获取前头有几个空格
            $ps = substr_count($v->path,',')-1;
            //拼接  分类名
            // $v->catname = str_repeat('--',$ps).$v->catname;
            //------------重复几次-------重复的东西------------次数---后面的值
            $v->title = str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;',$ps).$v->title;
        }


        $res = Cate::find($id);

        return view('admin.cate.edit',[
            'title'=>'分类的修改页面',
            'res'=>$res,
            'rs'=>$rs,
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
        //只要title  其他的不要
        $res = $request->only('title');
        // dd($res);
        //修改数据
      
         try{

          $data = Cate::where('id',$id)->update($res);
            
            if($data){
                return redirect('/admin/cate')->with('success','修改成功');
            }

        }catch(\Exception $e){

            return back()->with('error','修改失败');
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
        // $cate = Cate::find($id);

      /*  $cate = Cate::all();
        // dd($cate);
        foreach($cate as $k => $v){
            dd ($v['pid']);
        }
        exit;
        $pid = */
        //查询pid
        $pid = DB::select('select pid from cate');

        dd($pid);


         try{
            $res = Cate::destroy($id);
            if($res){
                return redirect('/admin/cate')->with('success','删除成功');
            }
        }catch(\Exception $e){

            return back()->with('error','删除失败');
        }
    }
}
