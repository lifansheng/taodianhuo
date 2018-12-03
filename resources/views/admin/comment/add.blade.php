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
        <form class="mws-form" action="/admin/comment" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">
                
                <div class="mws-form-row">
                    <label class="mws-form-label">uid</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="uid">
                    </div>
                </div>
                <div class="mws-form-row">
                    <label class="mws-form-label">gid</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="gid">
                    </div>
                </div>
                <div class="mws-form-row">
                    
                    <label class="mws-form-label">好评度</label>
                    <div class="mws-form-item clearfix">
                        <ul class="mws-form-list inline">
                            <li><label><input type="radio" name='star' value="2" checked>好评</label></li>
    						<li><label><input type="radio" name='star' value="1">一般</label></li>
    						<li><label><input type="radio" name='star' value="0">不咋滴</label></li>
                        </ul>
                    </div>
                              
                </div>
 
                <div class="mws-form-row">
                    <label class="mws-form-label">内容</label>
                    <div class="mws-form-item">
                		<textarea name="content" rows="" cols="" class="required small"></textarea>
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