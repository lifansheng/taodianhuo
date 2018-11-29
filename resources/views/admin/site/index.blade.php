@extends('layout.admins')

@section('title',$title)

@section('content')


<style type="text/css">
        #toggle-button{ display: none; }
        .button-label{
            position: relative;
            display: inline-block;
            width: 80px;
            height: 30px;
            background-color: #ccc;
            box-shadow: #ccc 0px 0px 0px 2px;
            border-radius: 30px;
            overflow: hidden;
        }
        .circle{
            position: absolute;
            top: 0;
            left: 0;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #fff;
        }
        .button-label .text {
            line-height: 30px;
            font-size: 18px;
            text-shadow: 0 0 2px #ddd;
        }

        .on { color: #fff; display: none; text-indent: 10px;}
        .off { color: #fff; display: inline-block; text-indent: 34px;}
        .button-label .circle{
            left: 0;
            transition: all 0.3s;
        }
        #toggle-button:checked + label.button-label .circle{
            left: 50px;
        }
        #toggle-button:checked + label.button-label .on{ display: inline-block; }
        #toggle-button:checked + label.button-label .off{ display: none; }
        #toggle-button:checked + label.button-label{
            background-color: #51ccee;
        }

    </style>
    
          <div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                        <span><i class="icon-pencil"></i> {{$title}}</span>
                    </div>
                    <div class="mws-panel-body no-padding">


                        <form class="mws-form" method = "post" action="/admin/site/1" enctype="multipart/form-data" >
                            <div class="mws-form-inline">
                                <div class="mws-form-row">
                                    <label class="mws-form-label">名称</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large" name="name" value="{{$res -> name}}">
                                    </div>
                                </div>
                                <div class="mws-form-row">
                                    <label class="mws-form-label">网站描述</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large"  name="content" value="{{$res -> content}}">
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">联系电话</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large"  name="tel" value="{{$res -> tel}}">
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">时间</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large"  name="time" value="{{$res -> time}}">
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">地址</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large"  name="addr" value="{{$res -> addr}}">
                                    </div>
                                </div>
                                 <div class="mws-form-row">
                                    <label class="mws-form-label">详情</label>
                                    <div class="mws-form-item">
                                        <input type="text" class="large"  name="detail" value="{{$res -> detail}}">
                                    </div>
                                </div>

                                <div class="mws-form-row">
                                    <label class="mws-form-label">LOGO</label>
                                    <img src="{{$res -> logo}}">
                                    <div class="mws-form-item">
                                        <input type="file"  value="this is a readonly field"  name="logo">
                                    </div>
                                </div>
                             

{{csrf_field()}}
{{method_field('PUT')}}

                                
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
 


<!-- 


  <input type="checkbox" id="toggle-button" name="status" class="anniu"> 

                                    <label for="toggle-button" class="button-label">
                                        <span class="circle"></span>
                                        <input type="hidden" name="yc">

                                        <span class="text on" > <li><label><input type="radio" name="status" value="1" checked> 开启</label></li></span>
                                        <span class="text off"> <li><label><input type="radio" name="status" value="0" checked>关闭</label></li></span>

                                    </label>
 -->
                                    </div> <button class="btn btn-success"  id="preview-comment"style="margin-left: 400px">保存</button>

                                </div>
                            </div>
                        </form>
                    </div>      
                </div>
               
@stop

<!-- 右侧内容框架，更改从这里结束 -->
@section('js')
<script>

    //单击按钮进行修改

    $('.anniu').click(function(){


        //获取状态
        var um = $('.toggle-button-wrapper').text();

        
    })
        
</script>
@stop


