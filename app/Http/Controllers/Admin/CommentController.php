<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Comment;
use DB;
use App\Model\Admin\Goods;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        //1个条件的搜索
        //查询comment的内容
        $res = Comment::orderBy("id","desc")
            ->where(function($query) use($request){
                //检测关键字
               
                $content = $request->input("content");
                $oid = $request->input("oid");
                //如果用户名不为空
                if(!empty($content)) {
                    $query->where("content","like","%".$content."%");
                }
                if(!empty($oid)) {
                    $query->where("oid","like","%".$oid."%");
                }
            })
        ->paginate($request->input("num", 10));
        //获取商品的信息
        $goods = Goods::all();
        // dd($goods);
        // dd($res);        
        $user = DB::table('homes')->get();
        // dd($user); 
        return view('admin.comment.index',[
            'title'=>'评论的显示',
            'res'=>$res,
            'request'=>$request,
            'goods'=>$goods,
            'user'=>$user,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //测试
        // echo '123';


        return view('admin/comment/add',['title'=>'商品评论添加']);
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
        $res = $request->except('_token');
        // dd($res);
        //添加时间
        $res['addtime'] = date("Y-m-d H:i:s",time());
        // dd($res);
          try{
            //用模型添加数据
            $data = Comment::create($res);
            // dd($data);
            //成功 or 失败
            if($data){
                return redirect('/admin/comment')->with('success','添加成功');
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
        //评论表的单条信息
        $res = Comment::find($id);
        //商品表的单条信息
        $goods = DB::table('goods')->where('id',$res->gid)->first();
        // dd($goods);
        // exit; 
        //前台用户表的信息
        $user = DB::table('homes')->where('hid',$res->uid)->first();
    
        // dd($res);
        return view('admin.comment.edit',[
            'title'=>'修改页面',
            'res'=>$res,
            'goods'=>$goods,
            'user'=>$user
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
        $res = $request->except('_token','_method');
        // dd($res);
        try{
            //修改数据
            $data = Comment::where('id',$id)->update($res);
   
            return redirect('/admin/comment')->with('success','修改成功');

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

            $res = Comment::destroy($id);
            
            if($res){
                return redirect('/admin/comment')->with('success','删除成功');
            }
        }catch(\Exception $e){

            return back()->with('/admin/comment')->with('error','删除失败');
        }
    }
}
