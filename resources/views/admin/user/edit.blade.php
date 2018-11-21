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
            	显示错误信息
                <ul>
                	@foreach ($errors->all() as $error)
                	<li style='font-size:14px'>{{$error}}</li>
                	@endforeach
                </ul>
            </div>
            @endif

        	<form action="/admin/user/{{$res->id}}" method="post" class="mws-form" enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">用户名</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='username' value='{{$res->username}}'>
        				</div>
        			</div>


        			<div class="mws-form-row">
        				<label class="mws-form-label">手机号</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='phone' value="{{$res->phone}}">
        				</div>
        			</div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">邮箱</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='email' value="{{$res->email}}">
        				</div>
        			</div>
					
					<div class="mws-form-row">
                    	<label class="mws-form-label">头像</label>
                    	<div class="mws-form-item">
                        	<div style="position: relative;" class="fileinput-holder">
                                <img src="{{$res->profile}}" alt="">
                        		<input type="file" name='profile' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                        	</div>
                        </div>
                    </div>
        			
        			<div class="mws-form-row">
        				<label class="mws-form-label">状态</label>
        				<div class="mws-form-item clearfix">
        					<ul class="mws-form-list inline">
        						<li><label><input type="radio" name='status' value="1" @if($res->status== 1) checked @endif>开启</label></li>
        						<li><label><input type="radio" name='status' value="0" @if($res->status== 0) checked @endif>禁用</label></li>
        					</ul>
        				</div>
        			</div>
        		</div>
        		<div class="mws-button-row">
					{{csrf_field()}}

                    {{method_field('PUT')}}

        			<input type="submit" class="btn btn-primary" value="修改">
        			
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