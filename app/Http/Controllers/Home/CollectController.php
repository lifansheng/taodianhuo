<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Collection;
use App\Model\Admin\Goods;
use DB;
class CollectController extends Controller
{
    //
    public function index()
    {
        $hid = session('hid');
        $res = Collection::where('homeid',$hid)->orderBy('id','ace')->get();
        // dump($res);

    	return view('home.collection.index',[
            'title'=>'我的收藏',
            'res'=>$res
        ]);
    }

    // 加入收藏
    public function shoucang(Request $request)
    {
        $gid = $request->gid;
        $homeid = session('hid');
        // echo $gid;
        $data = Goods::where('id',$gid)->first();
        $rs = Collection::where(['gid'=>$gid,'homeid'=>$homeid])->count();
        // echo $rs;
        
        if($rs == 0){
            
            $res = Collection::insert($arr[]=array(
                'gid'=>$gid,
                'homeid'=>$homeid,
                'shopname'=>$data['gname'],
                'shopprice'=>$data['price'],
                'shopimgs'=>$data['imgs'],
            ));
            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }else{
            echo 2;
        }
    }

    // 取消收藏
    public function qushoucang(Request $request)
    {
        $id = $request->id;
        // echo $id;
        $res = Collection::where('id',$id)->delete();

        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

}
