@extends('layout.admins')
<style>
    span{
        color:red;
        font-size:15px;
        font-family:华文彩云;
    }
</style>
@section('title',$title)

@section('content')
    <div class="mws-panel grid_8">
        <div class="mws-panel-header">
            <span>{{$title}}</span>
        </div>
        <div class="mws-panel-body no-padding">

            @if (count($errors) > 0)
            <div class="mws-form-message error">
                显示错误信息
                <ul>
                    @foreach ($errors->all() as $error)
                    <li style='font-size:14px'>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="/admin/homeuser/{{$res->hid}}" method="post" class="mws-form" enctype='multipart/form-data'>
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">用户名</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='username' value='{{$res->username}}'>
                        <span class="ename" style="display:none;"> 用户名已被注册！</span>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">年龄</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='age' value="{{$res->age}}">
                            <span class="eage" style="display:none;"> 年龄不能为空！</span>
                        </div>
                    </div>


                    <div class="mws-form-row">
                        <label class="mws-form-label">手机号</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='phone_number' value="{{$res->phone_number}}">
                        <span class="ephone" style="display:none;"> 手机号码已被注册！</span>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">邮箱</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='email' value="{{$res->email}}">
                        <span class="eemail" style="display:none;"> 邮箱已被注册！</span>
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">头像</label>
                        <div class="mws-form-item">
                            <div style="position: relative;" class="fileinput-holder">
                                <img src="{{$res->pic}}" alt="" width="130">
                                <input type="file" name='pic' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mws-form-row">
                        <label class="mws-form-label">性别</label>
                        <div class="mws-form-item clearfix">
                            <ul class="mws-form-list inline">
                                <li><label><input type="radio" name='sex' value="m" @if($res->sex== 'm') checked @endif>男</label></li>
                                <li><label><input type="radio" name='sex' value="w" @if($res->sex== 'w') checked @endif>女</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mws-form-row">
                        <label class="mws-form-label">状态</label>
                        <div class="mws-form-item clearfix">
                            <ul class="mws-form-list inline">
                                <li><label><input type="radio" name='status' value="1" @if($res->status== '1') checked @endif>开启</label></li>
                                <li><label><input type="radio" name='status' value="0" @if($res->status== '0') checked @endif>关闭</label></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="mws-button-row">
                    {{csrf_field()}}

                    {{method_field('PUT')}}

                    <input type="submit" class="btn btn-primary" value="修改">
                    
                </div>
            </form>
        </div>      
    </div>
@stop

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var US = true;
    var PSS = true;
    var ES = true;
    var ASS = true;



    // 错误信息的显示样式
    $('.mws-form-message').delay(2000).fadeOut(2000);
    
    // 用户名验证
    $("input[name=username]").change(function(){
        // 设置变量t表示当前被选中的对象
        var t = $(this);
            
        // 获取用户输入的值
        var pv = $(this).val().trim();    // console.log(pv);

        // 用户名不能为空
        if (pv == "") {
            $(".ename").removeAttr("style");
            $(".ename").text(" 用户名不能为空!");
            t.css("border", "solid 2px red");  
            US = false;  
            return;
        }

        // 正则
        var reg = /^\w{6,18}$/;


        if (!reg.test(pv)) {

            // 如果不符合格式
            t.css("border", "solid 2px red");
            $(".ename").text(" 请输入6,18位数字字母或下划线组成的用户名！");
            $(".ename").removeAttr("style");
            US = false;

        } else {

            // 发送ajax与数据库做比对
            $.post("/admin/ajaxhomeusername", {hname:pv}, function(data){
                console.log(data);
                if (data == 0) {
                    t.css("border", "solid 2px red");
                    $(".ename").removeAttr("style");
                    $(".ename").text(" 用户名已被注册!");
                    US = false;
                } else if (data == 1) {
                    t.css("border", "solid 2px #CECECE");
                    $(".ename").attr("style","display:none");
                    US = true;
                }

            })
        }
        
    })


    // 年龄
    $("input[name=age]").change(function(){

        // 设置变量t表示当前被选中的对象
        var t = $(this);
            
        // 获取用户输入的值
        var pv = $(this).val().trim();    // console.log(pv);

        if(pv == ''){
            $(".eage").removeAttr("style");
            $(this).css("border", "solid 2px red");  
            ASS = false;
            return;
        }

        // 正则
        var reg = /^[1-9]{1,2}$/;

        if(!reg.test(pv)){
            $(this).css("border", "solid 2px red");
            $(".eage").text(" 请填写合理的年龄！");
            $(".eage").removeAttr("style");
            ASS = false;
        } else {
            $(this).css("border", "solid 2px #CECECE");
            $(".eage").attr("style","display:none");
            ASS = true;
        }

        
    })
  

    // 手机号码
    $("input[name=phone_number]").change(function(){

        // 设置变量t表示当前被选中的对象
        var t = $(this);
            
        // 获取用户输入的值
        var pv = $(this).val().trim();    // console.log(pv);

        // 手机号码不能为空
        if (pv == "") {
            $(".ephone").removeAttr("style");
            $(".ephone").text(" 手机号码不能为空!");
            t.css("border", "solid 2px red");  
            PSS = false;  
            return;
        }

        // 正则
        var reg = /^1[3456789]\d{9}$/;

        if (!reg.test(pv)) {

            // 如果不符合格式
            t.css("border", "solid 2px red");
            $(".ephone").text(" 请输入中国大陆格式手机号码！");
            $(".ephone").removeAttr("style");
            PSS = false;
        } else {
            // 发送ajax与数据库做比对
            $.post("/admin/ajaxhomephone", {phone:pv}, function(data){
                console.log(data);
                if (data == 0) {
                    t.css("border", "solid 2px red");
                    $(".ephone").removeAttr("style");
                    $(".ephone").text(" 手机号码已被注册!");
                    PSS = false;
                } else if (data == 1) {
                    t.css("border", "solid 2px #CECECE");
                    $(".ephone").attr("style","display:none");
                    PSS = true;
                }
            })
        }        
    })


   // 邮箱
   $("input[name=email]").change(function(){
        // 设置变量t表示当前被选中的对象
        var t = $(this);
            
        // 获取用户输入的值
        var pv = $(this).val().trim();    // console.log(pv);

        // 邮箱不能为空
        if (pv == "") {
            $(".eemail").removeAttr("style");
            $(".eemail").text(" 邮箱不能为空!");
            t.css("border", "solid 2px red");  
            ES = false;  
            return;
        }

        // 正则
        var reg = /^([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\-|\.]?)*[a-zA-Z0-9]+(\.[a-zA-Z]{2,3})+$/;

        if (!reg.test(pv)) {
            // 如果不符合格式
            t.css("border", "solid 2px red");
            $(".eemail").text(" 请输入正确的邮箱格式！");
            $(".eemail").removeAttr("style");
            ES = false;
        } else {
            // 发送ajax与数据库做比对
            $.post("/admin/ajaxhomeemail", {email:pv}, function(data){
                console.log(data);
                if (data == 0) {
                    t.css("border", "solid 2px red");
                    $(".eemail").removeAttr("style");
                    $(".eemail").text(" 邮箱已被注册!");
                    ES = false;
                } else if (data == 1) {
                    t.css("border", "solid 2px #CECECE");
                    $(".eemail").attr("style","display:none");
                    ES = true;
                }
            })
        }    
    })

    // 按钮点击事件
    $("input[type=submit]").click(function(){

        // $('input[name=phone_number]').trigger('change');
        // $('input[name=email]').trigger('change');
        // $('input[name=username]').trigger('change');
        // $('input[name=age]').trigger('change');

        if (US && ES && PSS && ASS) {
            return true;
        } else {
            return false;
        }
    })
</script>
@stop