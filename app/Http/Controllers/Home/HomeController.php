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
use Session;
use App\Model\Admin\Advert;
use App\Model\Admin\Link;
use App\Model\Admin\Site;
use App\Model\Admin\Comment;
use App\Model\Home\Footprint;


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
        //遍历得到商品表的所有数据
        $goods = Goods::all();
        //便利得到新闻表的所有信息
        $news = News::all();
        //便利得到所有轮播表的所有信息
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
        //没有用到 商品图片详情表
        $gpic = Gpic::all();
        // dd($gpic);
        // dd($goods);
        //得到广告表的所有信息
        $homeadv = Advert::all();
        // dd($homeadv);

        return view('home.index',[
            'title'=>'淘点货',
            'goods'=>$goods,
            //'imgs'=>$imgs 
            'news'=>$news,
            'gpic'=>$gpic,   
            'lunbo'=>$lunbo,
            'gpic'=>$gpic,
            "homeadv" => $homeadv
        ]);
    }

    // public function details()
    // {   

    //     return view('home.goods.details',['title'=>'详情页面']);
    // }


    //到详情页的方法
      public function details(Request $request)
    {
        //得到url地址栏得的id
        $id = $_GET['id'];
        
        // 得到当前的用户id
        $hid = session('hid');
        
        if ($hid){ 
            
            // 组成数组
            $arr = ['hid'=>$hid, "goods_id"=>$id];

            // 浏览的时间
            $arr["created_at"] = date("Y-m-d H:i:s",time());

            // 存数据
            Footprint::create($arr);
        }
       

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
        //通过cid取goods表里的相关所有数据 猜您喜欢
        $likes = Goods::where('cid',$cid)->get();
        // dd($likes);
        //得到友情链接的所有信息
        $link = Link::all();
        // dump($link);
        //促销商品
        $cuxiao = Goods::all();

        //comment 评论表
        $comment = Comment::all();
        // dd($comment);
        //用户
        $user = DB::table('homes')->get();
        // dd($user);
        return view('home/goods/details',[
            'title'=>'商品详情页',
            'goods'=>$goods,
            'gimg'=>$gimg,
            'likes'=>$likes,
            'link'=>$link,
            'cuxiao'=>$cuxiao,
            'comment'=>$comment,
            'user'=>$user
        ]);
    }

    //搜索的方法
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
        // dump($data[0]);
        // if(is_null($data[0])){
        //     echo 1;
        // }else{
        //     echo 0;
        // }

        // exit;
        $goods = Goods::all();
        return view('home.goods.search',[
            'title'=>'列表页面',
            'data'=>$data,
            'goods'=>$goods
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
          $goods = Goods::all();
         return view('home/goods/list',[
            'title'=>'查询页',
            'res'=>$res,
            'goods'=>$goods
        ]);
    }

    //向导***

    public function leader()
    {
        return view('/home/leader',['title'=>'淘点货网购小向导']);
    }

    //网站配置
      public static function fulei()
    {

        $sites = Site::all();
        // $links = Link::all();
     
         return $sites; 
          // return view('layout.index',['site' => $site, 
    }

    //友情链接
     public static function fulei2()
    {

        // $sites = Site::all();
        $links = Link::all();
     
         return $links; 
          // return view('layout.index',['site' => $site, 
    }


}
