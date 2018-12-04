@extends("layout.admins")

@section("title", $title)

@section("content")
<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>{{$title}}</span>
    </div>
</div>
<h1 style="margin-left:15px;color:#c03;font-family:华文彩云;">Sorry！您没有权限访问！请联系管理员！</h1>
@stop