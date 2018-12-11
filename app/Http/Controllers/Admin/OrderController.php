<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\Orders;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $res = Orders::with('orderaddr')->orderBy('hid','ace')->orderBy('id','ace')
            ->where(function($query) use($request){
                 //按照订单号查询
                $id = $request->input('oid');

                //如果订单号不为空
                if(!empty($id)) {
                    $query->where('oid','like','%'.$id.'%');
                }
                //如果收货人不为空
                // if(!empty($name)) {
                //     $query->where('name','like','%'.$name.'%');
                // }
            })
            ->paginate($request->input('num', 8));

            // dd($res);

        return view('admin.a_order.index',[
            'title'=>'订单管理',
            'res'=>$res,
            'request'=>$request
        ]);
    }


    // 订单详情
    public function details(Request $request,$oid)
    {
        // dd($oid);
        $data = Orders::where('oid',$oid) -> first();
        // dd($data);
        return view('admin.a_order.details',[
            'title'=>'订单详情',
            'data'=>$data
        ]);

    }

    // 发货
    public function fahuo($oid)
    {
        Orders::where('oid',$oid)->update(['status'=>'1']);
        return redirect('/admin/a_order');
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
    public function edit($oid)
    {
        $data = Orders::where('oid',$oid) -> first();
        // dd($data);
        return view('admin.a_order.edit',[
            'title'=>'修改订单',
            'data'=>$data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $oid)
    {
        $data = $request ->except('_token','_method');
        // dd($data);
        
        try{
            //实例化数据表
            $res = Orders::where('oid',$oid)->update($data);
            if($res){
                return redirect('/admin/a_order')->with('success','修改成功');
            }

        }catch(\Exception $e){

            return back()->with('error','修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($oid)
    {
        $stat = Orders::where('oid',$oid)->select('status')->first();
        // dd($stat);
        
        if($stat == '0'){
            //实例化数据表
            $res =Orders::where('oid',$oid)->delete();
                if($res){
                    return redirect('/admin/a_order')->with('success','删除成功');
                }
        }else{

            return back()->with('error','删除失败  (该订单还未完成)无法删除!!');
        }
    }
}
