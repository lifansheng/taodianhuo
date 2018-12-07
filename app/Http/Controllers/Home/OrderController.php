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
    }

    // 订单详情
    public function orderxiang(Request $request)
    {
        $oid = $_GET['oid'];
        // dd($oid);
        $res = Orders::where('oid',$oid)->first();
        // dd($res);
        return view('home.orders.orderxiang',[
            'title'=>'订单详情',
            'res'=>$res
        ]);
    }

    // 确认收货
    public function queren($oid)
    {
        Orders::where('oid',$oid)->update(['status'=>'4']);
        return redirect('/home/order');
    }

    // 删除订单
    public function shanorder($oid)
    {
        Orders::where('oid',$oid)->delete();
        return redirect('/home/order');
    }

    // 提醒发货
    public function tixing(Request $request)
    {
        $oid = $request->oid;
        $res = Orders::where('oid',$oid)->update(['status'=>'5']);
        if($res){
            echo 1;
        }else{
            echo 0;
        }
    }

}
