@extends("layout.admins")

@section("title", $title)

@section("content")
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
        <form class="mws-form" action="/admin/advert/{{$res->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">标题</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="title" value="{{$res->title}}">
                    </div>
                </div>
                <div class="mws-form-row">
                        <label class="mws-form-label">图片</label>
                        <div class="mws-form-item">
                            <img src="{{$res->pic}}" alt="" id="img1">
                            <div class="fileinput-holder" style="position: relative;">
                                <input name="pic" type="file" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;" type="file">
                            </div>
                        </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name="status" value="1" checked> 开启</label></li>
                            <li><label><input type="radio" name="status" value="0"> 禁用</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input value="修改" class="btn btn-info" type="submit">
            </div>
        </form>
    </div>      
</div>
@stop

@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);
    // $(function () {
    //     $("#file_upload").change(function () {
    //         var imgPath = $("#file_upload").val();
    //         if (imgPath == "") {
    //             alert("请选择上传图片！");
    //             return;
    //         }
    //         //判断上传文件的后缀名
    //         var strExtension = imgPath.substr(imgPath.lastIndexOf('.') + 1);
    //         if (strExtension != 'jpg' && strExtension != 'gif'
    //             && strExtension != 'png' && strExtension != 'bmp') {
    //             alert("请选择图片文件");
    //             return;
    //         }

    //         var formData = new FormData($('#art_form')[0]);
            
    //         $.ajax({
    //             type: "POST",
    //             url: "/admin/advuploads",
    //             data: formData,
    //             contentType: false,
    //             processData: false,
    //             success: function(data) {
    //                 console.log(data);
    //                 $('#img1').attr('src', data);
    //                 $('#art_thumb').val(data);
    //             },
    //             error: function(XMLHttpRequest, textStatus, errorThrown) {
    //                 alert("上传失败，请检查网络后重试");
    //             }
    //         });
    //     })
    // })
</script>
@stop