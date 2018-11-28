<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Model\Admin\News;

class NewsController extends Controller
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
        $res = News::orderBy("id","asc")
            ->where(function($query) use($request){
                //检测关键字
                $title = $request->input("title");
                $author = $request->input("author");
                //如果用户名不为空
                if(!empty($title)) {
                    $query->where("title","like","%".$title."%");
                }
                //如果邮箱不为空
                if(!empty($author)) {
                    $query->where("author","like","%".$author."%");
                }
            })
        ->paginate($request->input("num", 10));
        //显示页面
        return view('admin.news.index',[
            'title'=>'新闻的浏览',
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
        //

        // return view('admin.news.add',['title'=>'新闻的添加页面']);
         return view('admin.news.add',[
            'title'=>'新闻的添加',
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
        //除了_token不要
        $res = $request->except('_token');
        // dd($res);
        //添加时间
        $res['addtime'] = date("Y-m-d H:i:s",time());
        // dd($res);
        // $data = News::create($res);
        // dd($data);

        try{
            //用模型添加数据
            $data = News::create($res);
            // dd($data);
            //成功 or 失败
            if($data){
                return redirect('/admin/news')->with('success','添加成功');
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
        $res = news::find($id);
        // dd($res);
        return view('admin.news.edit',['title'=>'新闻的修改页面','res'=>$res]);

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
        //获取信息
        $res = $request->except('_token','_method');
        // dd($res,$id);
         try{

            $data = News::where('id',$id)->update($res);
   
            return redirect('/admin/news')->with('success','修改成功');

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
         try{

            $res = News::destroy($id);
            
            if($res){
                return redirect('/admin/news')->with('success','删除成功');
            }
        }catch(\Exception $e){

            return back()->with('/admin/news')->with('error','删除失败');
        }
    }
}
