<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Model\Home\Carts;
use App\Model\Home\Orders;
use App\Model\Admin\Address;
use DB;

class CartsController extends Controller
{

    /**
     * 加入购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function addCar(Request $request)
    {
        // $data = session('carts')?session('carts'):array();
        $id = $_GET['id'];
        // 通过商品id查询数据
        $data = Goods::where('id',$id)->first();
        // dd($data);
        $res = Carts::insert($arr[] = array(
            "gid"=>$id,
            "hid"=>session('hid'),
            "gname"=>$data['gname'],
            "price"=>$data['price'],
            "imgs"=>$data['imgs'],
            "size"=>$_GET['size'],
            "leixing"=>$_GET['leixing'],
            "stock" => $data['stock'],
            "cnt" => $_GET['num'],
        ));

        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }


    /**
     * 购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function shopcar()
    {
        // 从数据库中取出数据
        $rs = Carts::where('hid',session('hid'))->get();
        // dd($rs);
        return view('home.carts.index',[
            'title'=>'购物车',
            'rs'=>$rs
        ]);
    }

    // 购物车加
    public function carAdd(Request $request)
    {
        $data = $request->input('jia');
        // dd($data);
        $carts = Carts::find($data);
        // var_dump($cart);
        $carts->cnt += 1;
        $carts = $carts -> save();

        if ($carts) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // 购物车减
    public function carJian(Request $request)
    {
        $data = $request->input('jian');
        // dd($data);
        $carts = Carts::find($data);
        // var_dump($cart);
        $carts->cnt -= 1;

        if ($carts ->cnt <= 1) {
            $carts ->cnt = 1;
        }
        $carts = $carts -> save();

        if ($carts) {
            echo 1;
        } else {
            echo 0;
        }
    }

    // 删除选中的商品
    public function shopcart(Request $request)
    {   
        $gid = $request->gid; 
        // echo $gid;
        $res = DB::table('shopcar')->where('id',$gid)->delete();

        // $count = DB::table('cart')->count();

        if($res){

            echo 1;
        } else {

            echo 0;
        }
    }

    /**
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function liGo(Request $request)
    {

        $id = $_GET['id'];

        $hid = session('hid');
        // dd($hid);
        $addrs = Address::where('hid',$hid)->orderBy('status','desc') -> get();
        // dd($addrs);
        $data = Goods::where('id',$id) -> get();
        // dd($data);

        $data[0]['size'] = $_GET['size'];
        $data[0]['leixing'] = $_GET['leixing'];
        $data[0]['cnt'] = $_GET['num'];
        // dd($data);
        $request->session()->put('liGO',$data);
        return view('home.carts.jiesuan',[
            'title'=>'订单结算',
            'data'=>$data,
            'addrs'=>$addrs
        ]);
    }


    /**
     * 结算页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request -> all();
        // dd($id);
        session(['id'=>$id]);
        $data = Carts::find($id) -> all();
        // dd($data);
        return view('home.carts.jiesuan',[
            'title'=>'订单结算',
            'data'=>$data
        ]);
    }

    /**
     * 结算成功页 
     *
     * @return \Illuminate\Http\Response
     */
    public function cheng(Request $request)
    {

        if(!session('liGO')){
            $id = session('id');
            // dd($id);
            $data = Carts::find($id) -> all();
            // dd($data);
            for ($i=0; $i <count($id['carid']) ; $i++) { 
                Orders::insert($arr[] = array(
                    'oid'=>time().rand(111,999),
                    'hid'=>session('hid'),
                    'name'=>$data[$i]['gname'],
                    'imgs'=>$data[$i]['imgs'],
                    'addr'=>1,
                    'tel'=>1234567,
                    'cnt'=>$data[$i]['cnt'],
                    'addtime'=>time(),
                    'price'=>$data[$i]['price'],
                    'message'=>$_GET['liuyan'],
                    'status'=>1,
                ));
                // echo $i;
            }
        }else{
            $data = session('liGO');
            // dd($data);
            Orders::insert($arr[] = array(
                'oid'=>time().rand(111,999),
                'hid'=>session('hid'),
                'name'=>$data[0]['gname'],
                'imgs'=>$data[0]['imgs'],
                'addr'=>1,
                'tel'=>1234567890,
                'cnt'=>$data[0]['cnt'],
                'addtime'=>time(),
                'price'=>$data[0]['price'],
                'message'=>$_GET['liuyan'],
                'status'=>1,
            ));
        }

        return view('home.carts.cheng',[
            'title'=>'付款成功'
        ]);
    }
    
}
