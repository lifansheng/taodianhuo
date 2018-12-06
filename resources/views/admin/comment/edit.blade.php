@extends('layout.admins')

@section('title',$title);

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
        <form class="mws-form" action="/admin/comment/{{$res->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">
                
                <div class="mws-form-row">
                    <label class="mws-form-label">用户名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text"  value="{{$user->username}}" disabled="true">
                    </div>
                </div>
                 <div class="mws-form-row" hidden="ture">
                    <label class="mws-form-label">用户id</label>
                    <div class="mws-form-item">
                        <input class="small" type="hidden" name="uid" value="{{$res->uid}}">
                    </div>
                </div>
                <div class="mws-form-row" >
                    <label class="mws-form-label">订单id</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="oid" value="{{$res->oid}}" disabled>
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">商品名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text"  value="{{$goods->gname}}" disabled="true">
                    </div>
                </div>
				<div class="mws-form-row" hidden="ture">
                    <label class="mws-form-label">商品id</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="gid" value="{{$res->gid}}">
                    </div>
                </div>


                 <div class="mws-form-row">
                    <label class="mws-form-label">商品图片</label>
                    <div class="mws-form-item">
                        <img src="{{$goods->imgs}}" alt="" width="300px" height="300px">
                    </div>
                </div>
                <div class="mws-form-row">
                    
                    <label class="mws-form-label">好评度</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name='star' value="2"  @if($res->star == 2) checked @endif>好评</label></li>
    						<li><label><input type="radio" name='star' value="1"  @if($res->star == 1) checked @endif>一般</label></li>
    						<li><label><input type="radio" name='star' value="0"  @if($res->star == 0) checked @endif>不咋滴</label></li>
                        </ul>
                    </div>
                              
                </div>
 
                <div class="mws-form-row">
                    <label class="mws-form-label">内容</label>
                    <div class="mws-form-item">
                		<textarea name="content" rows="" cols="" class="required small">{{$res->content}}</textarea>
                    </div>
                </div>
            </div>
            {{method_field('PUT')}}
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
</script>
@stop