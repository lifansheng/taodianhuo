<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;
use App\Model\Admin\Goods;
use App\Model\Admin\Gpic;
use App\Model\Admin\News;
use App\Model\Admin\Lunbo;
use DB;
use App\Model\Admin\Advert;


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
        $lunbo = Lunbo::all();
        // dd($lunbo);
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
        // dd($goods);

        $homeadv = Advert::all();
        // dd($homeadv);
        return view('home.index',[
            'title'=>'淘点货',
            'goods'=>$goods,
            //'imgs'=>$imgs 
            'news'=>$news,
            'gpic'=>$gpic,   
            'lunbo'=>$lunbo   
            'gpic'=>$gpic,
            "homeadv" => $homeadv   
        ]);
    }

    



    // public function details()
    // {   

    //     return view('home.goods.details',['title'=>'详情页面']);
    // }
      public function details()
    {
        //
        //得到url地址栏得的id
        $id = $_GET['id'];
        // dd($id);
        // $goods = Goods::find($id);
        // dd($goods);
        //关联查询 goods表和gpic  商品表和商品图片表
         $good = Goods::with('gis')->where('id',$id)->get();
         // dd($good[0]);
         //商品表的一维数组  在HTML页面直接取就行啦
         $goods = $good[0];
         // dd($goods);
        // ........先遍历  4/3维数组
         // var_dump($comments[0]);
        /*foreach($comments[0] as $v){
            dump($v->name);//主表的信息
            dump($v['typec'][1]->childname);//子表的信息
        }*/
        // dd($goods->id);
        //遍历商品 ** 取 商品的图片表
        foreach($good as $k=>$v){
            // dd($v->content);
            // dd($v['gis']);
            $gimg = $v['gis'];
            // dd($gimg);
        }
        // dd($gimg);
        // dd($goods['cid']);
        $cid = $goods['cid'];
        // dd($likes);
        //通过cid取goods表里的相关所有数据
        $likes = Goods::where('cid',$cid)->get();
        // dd($likes);


        return view('home/goods/details',[
            'title'=>'商品详情页',
            'goods'=>$goods,
            'gimg'=>$gimg,
            'likes'=>$likes
        ]);
    }

    public function search(Request $request)
    {
        // dd($_GET['gname']);
        // $res = $request->only('gname');
        $res = $_GET['gname'];
        // dd($res);
        // exit;
        // select * form goods where gname("gname",'like',"%".$res."%");
        // $data = DB::select('select * form goods where ("gname","like","%".$res."%")');
        $data = Goods::where('gname','like','%'.$res.'%')->get();
        // dd($data);

        // dd($data);
           /*$res = News::orderBy("id","asc")
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

        ]);*/
        return view('home.goods.search',[
            'title'=>'列表页面',
            'data'=>$data
        ]);
    }

    //通过主页的分类 到 list列表页
    public function list(){
        //打印cid
        // dd($_GET['cid']);
        $cid = $_GET['cid'];
        // dd($cid);
         $res = Goods::where('cid',$cid)->get();
         // dd($res);
         return view('home/goods/list',[
            'title'=>'查询页',
            'res'=>$res,
        ]);
    }

}
