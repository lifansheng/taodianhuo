<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Home\Footprint;
use App\Model\Admin\Goods;

class FootprintController extends Controller
{
    public function footprint(Request $request)
    {
    	// 查询足迹信息和商品信息
    	// 反过来
    	$foots = Footprint::orderby("id","desc")->get();
    	// rsort($foots);
    	// dd($foots);
    	$goodss = Goods::all();

    	return view("home/footprint/footprint", [
    		"title" => "我的足迹",
    		"foots"=>$foots,
    		"goodss"=>$goodss
    	]);
    }

    // 删除足迹
    public function ajaxcheckfoots(Request $request)
    {
    	// 获取用户想要删除的足迹的id
    	$id = $request->get("ids");
    	// echo $id;

    	// 在数据库里删除该id
    	$res = Footprint::destroy($id);

    	if ($res) {
    		echo 1;
    	} else {
    		echo 0;
    	}
    }

    // 清空足迹
    public function ajaxcheckfootss(Request $request)
    {
        // 获取当前要删除的用户的id
        $hid = $request -> get("ids");
        // echo $id;

        // 删除数据库里该id下的所有足迹
        $res = Footprint::where("hid", $hid)->delete();

        if ($res) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
