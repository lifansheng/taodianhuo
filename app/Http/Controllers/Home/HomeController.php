<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\Cate;

class HomeController extends Controller
{

	 public static function getCateMessage($pid)
    {

        $cate = cate::where('pid',$pid)->get();
        
        $arr = [];

        foreach($cate as $k=>$v){

            if($v->pid==$pid){

                $v->sub=self::getCateMessage($v->id);

                $arr[]=$v;
            }
        }  
        return $arr;
    }



    public function details()
    {
        return view('home.goods.details');
    }

}
