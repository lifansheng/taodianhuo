@extends('layout.admins')

@section('title',$title)

@section('content')

<div class="mws-panel grid_8">
    <div class="mws-panel-header">
        <span>
            <i class="icon-table">
            </i>
            {{$title}}
        </span>
    </div>
    <div class="mws-panel-body no-padding">
        <div role="grid" class="dataTables_wrapper" id="DataTables_Table_1_wrapper">

        	<form action="/admin/order" method='get'>
            <div id="DataTables_Table_1_length" class="dataTables_length">
                <label>
                    显示
                    <select name="num" size="1" aria-controls="DataTables_Table_1">

                         <option value="8" @if($request->num == 8)  selected="selected" @endif>
                            8
                        </option>
                        <option value="15"  @if($request->num == 15)  selected="selected" @endif>
                            15
                        </option>
                        <option value="20"  @if($request->num == 20)  selected="selected" @endif>
                            20
                        </option>
                    </select>
                    条数据
                </label>
            </div>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>

                    订单号:
                    <input type="text" name='oid' value='{{$request->oid}}'>

                </label>

                <button class='btn btn-info'>搜索</button>
            </div>
            </form>

					

            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 60px;" aria-label="Engine version: activate to sort column ascending">
                            订单号
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 50px;" aria-label="Browser: activate to sort column ascending">
                            收货人
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 70px;" aria-label="Platform(s): activate to sort column ascending">
                        联系方式
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 133px;" aria-label="Engine version: activate to sort column ascending">
                            收货地址
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 90px;" aria-label="Engine version: activate to sort column ascending">
                            下单时间
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 133px;" aria-label="Engine version: activate to sort column ascending">
                            订单状态
                        </th>
                         <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 133px;" aria-label="Engine version: activate to sort column ascending">
                            操作
                        </th>
                        
                        
                        
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">
					@foreach($res as $k => $v)

					@if($k % 2 == 0)
					 	<tr class="odd">
					@else 
						<tr class="even">
					@endif

                  	<!-- <tr class='@if($k % 2 == 0) odd @else even @endif'> -->
                        <td class="">
                            {{$v->oid}}
                        </td>
                        <td class="name">
                            {{$v->addrname}}
                        </td>
                        
                        <td class="lurl">
                            {{$v->tel}}
                        </td>
                        <td class="lurl">
                            {{$v->addr.$v->xiangxiaddr}}
                        </td>

                        <td class="">
                            {{$v->addtime}}
                        </td>
                       <td>
                           @if ($v->status==2) 买家已付款(待发货)
                           @elseif ($v->status == 1) 已发货(等待买家确认收货)
                           @elseif ($v->status == 0) 交易完成
                           @else ($v->status == 3) 买家申请退款
                           @endif
                       </td>
                        <td class=" ">
                            @if($v->status == 2)
                            <button type="button" class="btn btn-success" onclick="window.location='/admin/fahuo/{{$v->oid}}'">发货</button>
                            @endif
                            <a href="/admin/details/{{$v->oid}}" class="btn btn-warning">详情</a>

                            <a href="/admin/a_order/{{$v->oid}}/edit" class='btn btn-info'>修改</a>

                            <form action="/admin/a_order/{{$v->oid}}" method='post' style='display:inline'>
                            	{{csrf_field()}}

                            	{{method_field("DELETE")}}
                            	<button class='btn btn-danger'>删除</button>

                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
			
			<style>
            .pagination li a{

                color: #fff;
            }
                
            .pagination li{
                    float: left;
                    height: 20px;
                    padding: 0 10px;
                    display: block;
                    font-size: 12px;
                    line-height: 20px;
                    text-align: center;
                    cursor: pointer;
                    outline: none;
                    background-color: #444444;
                    
                    text-decoration: none;
                  
                    border-right: 1px solid rgba(0, 0, 0, 0.5);
                    border-left: 1px solid rgba(255, 255, 255, 0.15);
                   
                    box-shadow: 0px 1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.15);
                }

            .pagination  .active{
                color: #323232;
                border: none;
                background-image: none;
                background-color: #88a9eb;
               
                box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.25);
            }

            .pagination .disabled{
                color: #666666;
                cursor: default;

            }
                
            .pagination{
                margin:0px;
            }
            </style>
            <div class="dataTables_info" id="DataTables_Table_1_info">
                显示当前页码是{{$res->currentPage()}} 从{{$res->firstItem()}} to {{$res->lastItem()}} 一共{{$res->total()}}条数据
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                
                {{$res->appends($request->all())->links()}}

            </div>  
        </div>
    </div>
</div>

@stop

@section('js')

@stop