<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Address;
use App\Model\Home\Orders;

class OrderController extends Controller
{
    /**
     * 订单管理
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $hid = session('hid');
        $data = Orders::where('hid',$hid)->get();
        // dd($data);
        return view('home.orders.index',[
            'title'=>'订单管理',
            'data'=>$data
        ]);
    }

    /**
     * 付款页ajax修改默认地址
     *
     * @return \Illuminate\Http\Response
     */
    public function addrdefault(Request $request)
    {
        $aid = $request ->aid;
        $aa = Address::where('status','1')->update(['status'=>'0']);
        $bb = Address::where('id',$aid) -> update(['status'=>'1']);
        // dump($aa);
        if($bb){
            echo 1;
        }else{
            echo 0;
        }
    }


}
