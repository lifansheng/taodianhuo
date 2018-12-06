<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Orders;
use App\Model\Admin\Goods;

use App\Model\Admin\Comment;
use DB;

class CommentController extends Controller
{
    //
    public function comment()
    {
    	$oid = $_GET['oid'];
    	// dd($oid);
    	$data = DB::table('order')->where('oid',$oid)->first();
    	// dd($data);

    	return view('home/goods/comment',[
    		'title'=>'用户评论',
    		'data'=>$data
    	]);
    }

    //添加评论
    public function create(Request $request){
    	// echo '123';
    	$res = $request -> except('_token');
    	$res['addtime'] = date("Y-m-d H:i:s",time());
    	// $data = Comment::create($res);
    	// dd($data);
    	// dd($res);
    	// dd($res['oid']);
    	// if($res['oid'] == )
    	$order = DB::table('order')->where('oid',$res['oid'])->update(['status' => '0']);
    		// DB::table('order')->where('oid',$oid)->first();
    	// exit;
    	try{

    		$data = Comment::create($res);
           
            if($data){
                return redirect('/home/order')->with('success','评论成功！！！！');
            }
        }catch(\Exception $e){

            return back()->with('/home/comment')->with('error','评论失败！！！！请再次评论');
        }
    }

    // //查看所有的评价
    // public function all(){
    // 	// echo 'l';

    // 	return view('home.goods.pinglun',['title'=>'全部评论']);
    // }


}
