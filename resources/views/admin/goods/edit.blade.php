@extends('layout.admins')

@section('title',$title)

 <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>
    <script type="text/javascript" charset="utf-8" src="/admins/js/libs/jquery-1.8.3.min.js"></script>
    
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
        <form class="mws-form" id='art_form' action="/admin/goods/{{$res->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">

               <div class="mws-form-row">
                    <label class="mws-form-label">分类名</label>
                    <div class="mws-form-item">
                        <select class="small" name='cid' disabled>
                            <option value='0'>请选择</option>
                            @foreach($rs as $v)

                             @if($res->cid == $v->id)
                                <option value='{{$v->id}}'  selected  >{{$v->title}}</option>
                                @else
                                <option value='{{$v->id}}' >{{$v->title}}</option>
                                @endif
                            <!-- <option value='{{$v->id}}'>{{$v->catname}}</option> -->
                            @endforeach
                        </select>
                    </div>
                </div>
         
                <div class="mws-form-row">
                    <label class="mws-form-label">商品名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="gname" value="{{$res->gname}}">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">价格</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="price" value="{{$res->price}}">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">口味</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="color" value="{{$res->color}}">
                    </div>
                </div>
               <div class="mws-form-row">
                    <label class="mws-form-label">规格</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="size" value="{{$res->size}}">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">库存</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="stock" value="{{$res->stock}}">
                    </div>
                </div>
                 <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name='status' value="1" @if($res->status == 1) checked @endif>上架</label></li>
                            <li><label><input type="radio" name='status' value="0" @if($res->status == 0) checked @endif>下架</label></li>
                            <li><label><input type="radio" name='status' value="2" @if($res->status == 2) checked @endif>促销</label></li>

                        </ul>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品主图片</label>
                    <div class="mws-form-item">
                        <div style="position: relative;" class="fileinput-holder">
                            <img src="{{$res->imgs}}" alt="上传后显示图片" id="imgs" style='width:100px;height:100px' >
                            <input id="file_upload" type="file" name="imgs" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        </div>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品图片</label>
                    <div class="mws-form-item">
                        <div style="position: relative;" class="fileinput-holder">
                            @foreach($gimgs as $v)
                            <!-- <img src="{{$v->gimg}}" class="gimgss" gpic="{{$v->id}}" alt="" style='width:100px;height:100px'> -->
                            <img src="{{$v->gimg}}" class="gimgs" gpic="{{$v->id}}" style='width:100px;height:100px;'>
                            @endforeach
                            <input type="file" name="gimg[]" multiple  style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">

                        </div>
                    </div>
                </div>
                <div class="mws-form-row">
    				<label class="mws-form-label">详情</label>
    				<div class="mws-form-item">
    					<script id="editor" name='content' type="text/plain" style="width:800px;height:500px;">{!!$res->content!!}</script>
    				</div>
    			</div>
              
               
            </div>
            <div class="mws-button-row">
            	{{csrf_field()}}
                {{method_field('PUT')}}
                <input value='修改' class="btn btn-info" type="submit">
            	
            </div>
        </form>
    </div>      
</div>
@stop

@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);

     var ue = UE.getEditor('editor');

     // $('.imgs').click(function(){

 
    // $('.gimgs').dblclick(function(){
    //     // alert(123);
    //     var gid = $(this).attr('gpic');
    //     // console.log(gid);
    //     $.get('/admin/goods/'+gid,{},function(data){
    //         console.log(data);
    //      })
    // })
</script>
<script>
    //发送ajax双击删除图片
    $('.gimgs').dblclick(function(){
        // alert(123);
        var gid = $(this).attr('gpic');
        // console.log(gid);
        var gv = $(this);
        $.get('/admin/goodsajaxs',{gid:gid},function(data){
            // console.log(data);
                if(data == 1){
                gv.remove();
            }
        })
        // $.ajax({
        //     url:'/admin/goodsajax',
        //     type:'GET',
        //     data:{gid:gid},
        //     success:function(data){
        //         console.log(data);
        //     },
        //     error:function(){
        //         alert('出错啦');
        //     },
        //     async:true,
        // })

    })
</script>
<script>
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
     $(function () {
        $("#file_upload").change(function () {

            var imgPath = $("#file_upload").val();

            if (imgPath == "") {
                alert("请选择上传图片！");
                return;
            }
            //判断上传文件的后缀名
            var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
            if (strExtension != 'jpg' && strExtension != 'gif'
                && strExtension != 'png' && strExtension != 'bmp') {
                alert("请选择图片文件");
                return;
            }

            var formData = new FormData($('#art_form')[0]);

            $.ajax({
                type: "POST",
                url: "/admin/edituajax",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#imgs').attr('src',data);
                    // $('#art_thumb').val(data);

                    // setTimeout(function(){
                    // location.href = '/admin';
                    // },1000)

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                    // console.log(data);
                }
            });
        })
    })
</script>
</script>
@stop