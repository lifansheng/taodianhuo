<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class PersonController extends Controller
{
    //
    public function pindex(){

    	return view('home.person.sy');
    }


    public function index(){
    			$res = session('hid');
    			// dd($res);
    			$data = DB::table('homes')->where('hid',$res)->first();
// dd($data);
    	return view('home.person.information',['data'=>$data]);
    }



      public function update(Request $request, $id)
    {

        $res =$request ->except('_token','pic','_method');
      
        if($request->hasFile('pic')) {
            //自定义名字
            $name = rand(111,999).time();

            //获取后缀
            $suffix = $request->file('pic')->getClientOriginalExtension();

            $request ->file('pic')->move('./uploads', $name.'.'.$suffix);

            $res['pic'] ='/uploads/'.$name.'.'.$suffix;

           
            # code...
        }


        try{

            $data = DB::table('homes') ->where('hid',session('hid'))->update($res);
                
           
                // dd($data);
        }catch(\Exception $e){

            return back()->with('error','修改失败');
        }         
        
                return redirect('/home/personinformation')->with('success', '修改成功');
        // 
        
    }

    public function safety()
    {
        return view("home/person/safety", [
            "title"=>"安全设置"
        ]);
    }
}
