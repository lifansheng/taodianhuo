@extends('layout.admins')

@section('title',$title)

@section('content')

<div class="mws-panel grid_8">
	<div class="mws-panel-header">
    	<span>{{$title}}</span>
    </div>
    <div class="mws-panel-body no-padding">

        @if (count($errors) > 0)
            <div class="mws-form-message error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li style='font-size:16px;list-style:none'>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id='art_form' class="mws-form" method="post" action="/admin/lunbo/{{$data['id']}}" enctype="multipart/form-data">

        <div class="mws-form-inline">

            <div class="mws-form-row">
                <label  class="mws-form-label">
                   轮播图:
                </label>
                <div class="mws-form-item">
                    <img src="{{$data->pic}}" id="imgs">
                    <div style="position: relative;" class="fileinput-holder">
                        <input id="file_upload" type="file" name='pic' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                    </div>
                </div>
            </div>

            <div class="mws-form-row">
                <label  class="mws-form-label">
                   标题:
                </label>
                <div class="mws-form-item">
                    <input type="text"  name="title" value="{{$data->title}}" class="layui-input">
                </div>
            </div>

            <!-- <div class="mws-form-row">
                <label  class="mws-form-label">
                   轮播图:
                </label>
                <div class="mws-form-item">
                    <img src="{{$data->pic}}" style="width: 150px;height: 150px;">
                    <input type="file"  name="pic" value="" class="layui-input">
                </div>
            </div> -->

            <div class="mws-form-row">
                <label  class="mws-form-label">
                   跳转地址:
                </label>
                <div class="mws-form-item">
                    <input type="text"  name="url" value="{{$data->url}}" class="layui-input">
                </div>
            </div>

        </div>
            <div class="mws-button-row">

                {{csrf_field()}}

                {{method_field('PUT')}}
                <input type="submit" class="btn btn-info" value="确认修改">
            </div>
        </form>
    </div>    	
</div>

@stop

@section('js')
<script type="text/javascript">
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
                url: "/admin/upload",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#imgs').attr('src',data);
                    // $('#art_thumb').val(data);
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("上传失败，请检查网络后重试");
                }
            });
        })
    })
</script>

@stop