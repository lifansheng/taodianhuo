<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use App\Model\Admin\Goods;
use App\Model\Admin\Gpic;
use App\Model\Admin\News;


class HomeController extends Controller
{

	 public static function getCateMessage($pid)
    {

        $cate = Cate::where('pid',$pid)->get();
        
        $arr = [];

        foreach($cate as $k=>$v){

            if($v->pid==$pid){

                $v->sub=self::getCateMessage($v->id);

                $arr[]=$v;
            }
        }  
        return $arr;
    }

    //首页的显示
    public function index()
    {   
        // $res = Goods::with('gis')->get();
        $goods = Goods::all();
        $news = News::all();
        // dd($news);
        // $cate = 
        // dd($res);
        // var_dump($res);
        // exit;
         // $cate = Cate::find();
        // $imgs = [];
        // foreach($goods as $k => $v){
        //     $cate = Cate::find($v['cid']);
        //     // dump($cate->path);
        //     $cates = $cate->path;
        //     // dump($cates);
        //     $arrs = explode(',',$cates);
        //     // dump($arrs);
        //     array_pop($arrs);
        //      // dump($arrs);
        //     $imgs[] = $arrs;
        //  }
        // dump($imgs);
        // $comments = Cate::with('cate')->all();
        // // ........先遍历  4/3维数组
        // foreach($comments as $v){
            // dump($v->name);//主表的信息
            // dump($v);
            // dump($v['cate']->c);//子表的信息
        // }

        // exit;
        $gpic = Gpic::all();
        // dd($gpic);

        return view('home.index',[
            'title'=>'淘点货',
            'goods'=>$goods,
            //'imgs'=>$imgs 
            'news'=>$news,
            'gpic'=>$gpic     
        ]);
    }

    



    // public function details()
    // {   

    //     return view('home.goods.details',['title'=>'详情页面']);
    // }
      public function details()
    {
        //
        $id = $_GET['id'];
        // dd($id);
        // $goods = Goods::find($id);
        // dd($goods);
         $good = Goods::with('gis')->where('id',$id)->get();
         // dd($good[0]);
         $goods = $good[0];
         // dd($goods);
        // ........先遍历  4/3维数组
         // var_dump($comments[0]);
        /*foreach($comments[0] as $v){
            dump($v->name);//主表的信息
            dump($v['typec'][1]->childname);//子表的信息
        }*/
        // dd($goods->id);
        foreach($good as $k=>$v){
            // dd($v->content);
            // dd($v['gis']);
            $gimg = $v['gis'];
            // dd($gimg);
        }
        // dd($gimg);

        return view('home/goods/details',[
            'goods'=>$goods,
            'gimg'=>$gimg
        ]);
    }

}
