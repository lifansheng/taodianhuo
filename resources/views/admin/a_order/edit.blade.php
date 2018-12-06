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

        	<form action="/admin/a_order/{{$data->oid}}" method="post" class="mws-form" enctype='multipart/form-data'>
        		<div class="mws-form-inline">
        			<div class="mws-form-row">
        				<label class="mws-form-label">订单号</label>
        				<div class="mws-form-item">
        					<input type="text" class="small" name='oid' disabled value='{{$data->oid}}'>
        				</div>
        			</div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">收货人</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='addrname' value='{{$data->addrname}}'>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">联系电话</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='tel' value='{{$data->tel}}'>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">收货地址</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='xiangxiaddr' value='{{$data->xiangxiaddr}}'>
                        </div>
                    </div>

                    <div class="mws-form-row">
                        <label class="mws-form-label">订单状态</label>
                        <div class="mws-form-item">
                            <select class="small" name='status'>
                                <option value='2' @if ($data->status == 2) selected @endif>已付款(待发货)</option>
                                <option value='1' @if ($data->status == 1) selected @endif>已发货(待确认收货)</option>
                                <option value='0' @if ($data->status == 0) selected @endif>交易完成</option>
                                <option value='3' @if ($data->status == 3) selected @endif>买家申请退款</option>                                     
                            </select>
                        </div>
                    </div>

            		<div class="mws-button-row">
        				{{csrf_field()}}

                        {{method_field('PUT')}}

            			<input type="submit" class="btn btn-primary" value="修改">
            			
                    </div>
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