<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Goods;
use App\Model\Home\Carts;
use DB;

class CartsController extends Controller
{
    /**
     * 购物车
     *
     * @return \Illuminate\Http\Response
     */
    public function shopcar()
    {
        //
        // $res = Carts::find(1)->goodcar()->where('hid',27)->first();
        $res = Carts::where('hid',27)->pluck('gid');
        // dd($res);
        $rs = Carts::with('goodcar')->where('hid',27)->get();
        // dd($rs);
        return view('home.carts.index',[
            'title'=>'购物车',
            'rs'=>$rs
        ]);
    }

    // 删除选中的商品
    public function shopcart(Request $request)
    {   
        $gid = $request->gid; 

        $res = DB::table('shopcar')->where('gid',$gid)->delete();

        // $count = DB::table('cart')->count();

        if($res){

            echo 1;
        } else {

            echo 0;
        }
    }

    /**
     * 结算页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        

        return view('home.carts.jiesuan',[
            'title'=>'订单结算'
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
}
