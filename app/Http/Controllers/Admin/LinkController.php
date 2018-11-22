<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Link;
use App\Http\Requests\LinkRequest;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
            $res = Link::orderBy('id', 'asc')->where(function($query) use($request){

                //检测关键字
                $lname = $request->input('lname');
                $lurl = $request->input('lurl');

                //如果用户名不为空
                if (!empty($lname)) {
                    $query->where('lname', 'like','%'.$lname.'%');
                    # code...
                }

                //如果地址不为空
                if (!empty($lurl)) {
                    $query->where('lurl','like','%'.$lurl.'%');
                    # code...
                }
            })->paginate($request -> input('num', 10));
             // dd($res);
        return view('admin.link.index',['title' => '友情链接','request' => $request, 'res' => $res]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        return view('admin.link.add', ['title' => '添加链接']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {

            $res = $request -> except('_token','lpic');

            // dd($res);
             if($request->hasFile('lpic')){
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('lpic')->getClientOriginalExtension();

            $request->file('lpic')->move('./uploads',$name.'.'.$suffix);

            $res['lpic'] = '/uploads/'.$name.'.'.$suffix;

             try{

            $data = Link::create($res);
            
            if($data){
                return redirect('admin/link')->with('success','添加成功');
            }

        }catch(\Exception $e){

            return back()->with('error','添加失败');
        }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responselin'k
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
        $res =Link::find($id);

        // return view('admin.link.edit',['title' => '链接的修改页面'，'res' =>$res]);
         return view('admin.link.edit',[
            'title'=>'用户的修改页面',
            'res'=>$res
        ]);
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
        $res =$request ->except('_token','lpic','_method');
        // dd($res);
        if($request->hasFile('lpic')) {
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('lpic')->getClientOriginalExtension();

            $request ->file('lpic')->move('./uploads', $name.'.'.$suffix);

            $res['lpic'] ='/uploads/'.$name.'.'.$suffix;

            // dd($res);
            # code...
        }

        try{

            $data = Link::where('id', $id) ->update($res);
                // dd($data);
            if ($data) {
                return redirect('/admin/link')->with('success', '修改成功');
                # code...
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
    public function destroy($id)
    {
        
         try{

            $res = Link::destroy($id);
            
            if($res){
                return redirect('/admin/link')->with('success','删除成功');
            }

        }catch(\Exception $e){

            return back()->with('error','删除失败');
        }

    }



    public function ajaxupdate(Request $request)
    {
        //判断空 

        //判断用户名是否一样

        //判断位数 6~12

        $res = [];

        $id = $request->ids;

        $res['lname'] = $request->lv;

        //修改数据
        $data = Link::where('id',$id)->update($res);

        if($data){

            echo 1;
        } else {

            echo 0;
        }


    }



}
