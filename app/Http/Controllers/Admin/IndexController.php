<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    //
    public function indexs()
    {
    	return view('admin.index',['title'=>'lamp210小网站后台首页']);
    }
}
