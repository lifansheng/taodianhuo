<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class AddressController extends Controller
{
    //
    public function index(){


    	// $res = session('hid');
    	$data = DB::table('address')->get();
    	// dd($data);
    	return view('home.person.address',['data' => $data]);
    }


    public function store(Request $request){

    	$res = $request -> except('_token');
    	// dd($res);
    	$res['hid'] = session('hid');
    	// dd($res);
    	 // $data = DB::table('address')->insert($res);
            // dd($data);
    	try{

            $data = DB::table('address')->insert($res);
            // dd($data);
            if($data){
                return redirect('home/address')->with('success','添加成功');
            }

        }catch(\Exception $e){

            return back()->with('error','添加失败');
        }
    }


    public function destroy($id){

    	$res = DB::table('address')->where('id',$id)->delete();
    	// dd($res);
    	try{
    		if ($res) {

    						return redirect('/home/address')->with('success','删除成功');
    			# code...
    		}
    	}catch(\Exception $e){

    		return back() -> with('error','删除失败');
    	}




    }




    public function edit($id){

        $res = DB::table('address')->find($id);
        // dd($res);
        return view('home.person.addressedit',['res' => $res]);


    }


    public function update(Request $request,$id)
    {

            $res = $request->except('_token','_method');
            // dd($res);
            try{
            $data = DB::table('address')->where('id',$id)->update($res);
}catch(\Exception $e){
    return back() ->with('error','修改失败');
}

    return redirect('/home/address')->with('success', '修改成功');
    }


public function adajax(Request $request){
    // echo 1;
    $ids = $request ->ids;
    $hid = $request ->hid;
    // echo $hid;
//通过hid获取所有的status
    // $st = [];
    $st = Db::table('address')->where('status','=','1')->where('hid',$hid)->get();




    //通过id获取状态
    $status = DB::table('address')->where('id',$ids)->first();
    $s= $status->status;


    // $d = array_map('get_object_vars', $st);
    //默认地址的id
     $mid = $st[0]->id;

     if ($ids !== $mid) {

         //修改状态为默认
     DB::table('address')->where('id',$ids)->update(['status'=>'1']);
     DB::table('address')->where('id',$mid)->update(['status'=>'0']);
     


         # code...
     }else{
         DB::table('address')->where('id',$ids)->update(['status'=>'0']);
     DB::table('address')->where('id',$mid)->update(['status'=>'1']);
     }





//     foreach ($st as $key => $value) {
//         if ($hid == $value->hid) {
//             // $sta =[];
//               $sta = $value->status; # code...
              
//  // $string = [];
//               // $string = explode("\n",$sta);
//               // $array = array_merge($string);
//               // $string = arr/ay_merge_recursive($sta);


// // var_dump($st);
            
//         }
     
//         # code...
//     }
    // var_dump($st);






    // //通过id获取状态
    // $status = DB::table('address')->where('id',$ids)->first();
    // $s= $status->status;

    // if ($s == '0') {


       


    // }
// echo $ids;
   //      if ($status == 0) {

   // DB::table('address')->where('id',$id)->update(['status'=>'1']);}
            # code...
        
     



    // $aid= DB::table('address')->where('status',$status)->get();

// echo $status;



//获取的状态
    // return $aid;
// $aid = Db::table('address')->value('id');
// echo $aid;
       // $status =[];
       //   $status[$aid] = DB::table('address')->value('status');

         // var_dump($status);   
        // $res['status'] = '1'; 
        // var_dump($res);
          // $data = DB::table('address')->where('id',$id)->update(['status'=>'1']);
         // echo $data;


     

}



    }




