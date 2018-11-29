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

    	$res = Site::select();
    	$user = User::select();
    return view('admin.site.index',['title'=>'网站配置','res' => $res,'user'=> $user]);
}
}
