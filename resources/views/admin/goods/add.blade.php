@extends('layout.admins')

@section('title',$title)

 <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>

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
        <form class="mws-form" action="/admin/goods" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">

               <div class="mws-form-row">
                    <label class="mws-form-label">分类名</label>
                    <div class="mws-form-item">
                        <select class="small" name='cid'>
                            <option value='0'>请选择</option>
                            @foreach($rs as $v)
                            	<option value='{{$v->id}}'>{{$v->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
         
                <div class="mws-form-row">
                    <label class="mws-form-label">商品名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="gname" placeholder="请输入商品名"><span></span>
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">价格</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="price" placeholder="请输入价格">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">口味</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="color" placeholder="不同口味尽量用逗号隔开">
                    </div>
                </div>
               <div class="mws-form-row">
                    <label class="mws-form-label">规格</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="size" placeholder="不同规格尽量用逗号隔开">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">库存</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="stock" placeholder="请输入库存">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品主图片</label>
                    <div class="mws-form-item">
                        <div style="position: relative;" class="fileinput-holder">
                            <input type="file" name="imgs" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">详情</label>
    				<div class="mws-form-item">
    					<script id="editor" name='content' type="text/plain" style="width:800px;height:500px;"></script>
    				</div>
    			</div>
               <div class="mws-form-row">
                	<label class="mws-form-label">商品图片</label>
                	<div class="mws-form-item">
                    	<div style="position: relative;" class="fileinput-holder">
                    		<input type="file" name="gimg[]" multiple  style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                    	</div>
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">状态</label>
    				<div class="mws-form-item clearfix">
    					<ul class="mws-form-list inline">
    						<li><label><input type="radio" name='status' value="1" checked>上架</label></li>
                            <li><label><input type="radio" name='status' value="0">下架</label></li>
    						<li><label><input type="radio" name='status' value="2">促销</label></li>
    					</ul>
    				</div>
    			</div>
            </div>
            <div class="mws-button-row">
            	{{csrf_field()}}
                <input value="添加" class="btn btn-info" type="submit">
            	
            </div>
        </form>
    </div>      
</div>
@stop

@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);

    var ue = UE.getEditor('editor');


    //     var GN = true;

    //     var gname = $('input[name = gname]').blur(function(){

    //         // alert(123);
    //         var uv = $(this).val().trim();
    //         if(uv == ''){
    //         $(this).next().text(' *商品名不能为空').css('color','#e53e41');

    //         $(this).css('border','solid 2px #e53e41');

    //         GN = false;
    //         return;
    //     }
    //     //正则
    //     var reg = /^\S{13,26}$/;
    //     // var reg=/^[\u4e00-\u9fa5]+$/;
    //     // var tg = $(this);
    //     //检测
    //     console.log(uv);
    //     if(!reg.test(uv)){
    //         $(this).next().text(' *用商品名格式不正确').css('color','#e53e41');

    //         $(this).css('border','solid 2px #e53e41');

    //         GN = false;
    //     }else{
    //         $(this).next().text(' *√').css('color','green');
    //         $(this).css('border','solid 2px green');
    //         GN = true;
    //     }
    // });
</script>
@stop