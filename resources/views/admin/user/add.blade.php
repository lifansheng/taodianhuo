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
        <form class="mws-form" action="/admin/user" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">用户名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="username">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">密码</label>
                    <div class="mws-form-item">
                        <input class="small" type="password" name="password">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">确认密码</label>
                    <div class="mws-form-item">
                        <input class="small" type="password" name="repass">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">年龄</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="age">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">手机号码</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="tel">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">邮箱</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="email">
                    </div>
                </div>
                <div class="mws-form-row">
                        <label class="mws-form-label">头像</label>
                        <div class="mws-form-item">
                            <div class="fileinput-holder" style="position: relative;">
                                <input name="pic" type="file" style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;" type="file">
                            </div>
                        </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">性别</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name="sex" value="m" checked> 男</label></li>
                            <li><label><input type="radio" name="sex" value="w"> 女</label></li>
                        </ul>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">状态</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name="auth" value="1" checked> 开启</label></li>
                            <li><label><input type="radio" name="auth" value="0"> 禁用</label></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mws-button-row">
                <input value="添加" class="btn btn-info" type="submit">
            </div>
        </form>
    </div>      
</div>
@stop

@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);
</script>
@stop