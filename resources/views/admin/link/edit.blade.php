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

        	<form action="/admin/link/{{$res->id}}" method="post" class="mws-form" enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">链接名称</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='lname' value='{{$res->lname}}'>
        				</div>
        			</div>
                            <div class="mws-form-row">
                        <label class="mws-form-label">图片</label>
                        <div class="mws-form-item">
                            <div style="position: relative;" class="fileinput-holder">
                                <img src="{{$res->lpic}}" alt="">
                                <input type="file" name='lpic' style="position: absolute; top: 0px; right: 0px; margin: 0px; cursor: pointer; font-size: 999px; opacity: 0; z-index: 999;">
                            </div>
                        </div>
                    </div>

        			<div class="mws-form-row">
        				<label class="mws-form-label">地址</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='lurl' value="{{$res->lurl}}">
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