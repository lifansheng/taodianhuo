<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Address;

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
        return view('home.orders.index',[
            'title'=>'订单管理'
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
