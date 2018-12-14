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


    	<form action="/admin/lunbo" method='post' class="mws-form" enctype='multipart/form-data'>
    		<div class="mws-form-inline">

    			<div class="mws-form-row">
    				<label class="mws-form-label">标题</label>
    				<div class="mws-form-item">
    					<input type="text" name='title' class="small">
    				</div>
    			</div>

                <div class="mws-form-row">
                    <label class="mws-form-label">轮播图</label>
                    <div class="mws-form-item">
                        <input type="file" name='pic' class="fileinput-preview">
                    </div>
                </div>

                <div class="mws-form-row">
                    <label class="mws-form-label">轮播图背景色</label>
                    <div class="mws-form-item">
                        <input type="text" name='beijing' class="small">
                    </div>
                </div>

    			<div class="mws-form-row">
    				<label class="mws-form-label">跳转地址</label>
    				<div class="mws-form-item clearfix">
                        <input id="myform" type="text"  name="url" class="small">
    				</div>
    			</div>

    		</div>
    		<div class="mws-button-row">

    			{{csrf_field()}}
    			<input type="submit" class="btn btn-success" value="提交">
    		</div>
    	</form>
    </div>    	
</div>
@stop

<!-- 右侧内容框架，更改从这里结束 -->
@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);
</script>
@stop