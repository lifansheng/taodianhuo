<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Site;
use App\Model\Admin\User;

class SiteController extends Controller
{
    //
    public function index(){

        $res = Site::find(1);
        $user = User::select();
        
    
    return view('admin.site.index',['title'=>'网站配置','res' => $res,'user'=> $user]);
}


    public function update(Request $request, $id)
    {

        $res =$request ->except('_token','logo','_method');
        // dd($res);
        if($request->hasFile('logo')) {
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('logo')->getClientOriginalExtension();

            $request ->file('logo')->move('./uploads', $name.'.'.$suffix);

            $res['logo'] ='/uploads/'.$name.'.'.$suffix;

           
            # code...
        }


        try{

            $data = Site::where('id',$id) ->update($res);
                
           
                
        }catch(\Exception $e){

            return back()->with('error','修改失败');
        }
                return redirect('/admin/site')->with('success', '修改成功');
        
    }

}
