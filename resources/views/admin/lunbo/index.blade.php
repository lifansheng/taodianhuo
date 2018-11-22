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

          <form action="/admin/lunbo" method='get'>
            <div id="DataTables_Table_1_length" class="dataTables_length">
                <label>
                    显示
                    <select name="num" size="1" aria-controls="DataTables_Table_1">

                         <option value="3" @if($request->num == 3)  selected="selected" @endif>
                            3
                        </option>
                        <option value="5"  @if($request->num == 5)  selected="selected" @endif>
                            5
                        </option>
                        <option value="8"  @if($request->num == 8)  selected="selected" @endif>
                            8
                        </option>
                    </select>
                    条数据
                </label>
            </div>
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
                <label>
                    标题:

                    <input type="text" name='title' value="{{$request->title}}" aria-controls="DataTables_Table_1">

                </label>

                <button class='btn btn-info'>搜索</button>
            </div>
            </form>

            <table class="mws-datatable-fn mws-table dataTable" id="DataTables_Table_1"
            aria-describedby="DataTables_Table_1_info">
                <thead>
                    <tr role="row">
                        <th class="sorting_asc" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 50px;" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">
                            ID
                        </th>
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">
                           标题
                        </th>

                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">
                           轮播图
                        </th>
                        
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 80px;" aria-label="Engine version: activate to sort column ascending">
                            跳转路径
                        </th>

                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 100px;" aria-label="Browser: activate to sort column ascending">
                           创建时间
                        </th>
                     
                        <th class="sorting" role="columnheader" tabindex="0" aria-controls="DataTables_Table_1"
                        rowspan="1" colspan="1" style="width: 60px;" aria-label="CSS grade: activate to sort column ascending">
                           操作
                        </th>
                    </tr>
                </thead>
                <tbody role="alert" aria-live="polite" aria-relevant="all">

          @foreach($data as $k =>$v)
            <tr class='@if($k % 2 == 0) odd @else even @endif'>
                <td>{{$v['id']}}</td>
                <td>{{$v['title']}}</td>
                <td><img src="{{$v->pic}}" style="width: 252px;height: 158px;"></td>
                <td><a>{{$v['url']}}</a></td>
                <td>{{$v['addtime']}}</td>
                  <td class=" ">
                      <a href="/admin/lunbo/{{$v->id}}/edit" class='btn btn-info'>修改</a>

                      <form action="/admin/lunbo/{{$v->id}}" method='post' style='display:inline'>
                          
                          {{csrf_field()}}

                          {{method_field('DELETE')}}
                          <button href="" class='btn btn-warning'>删除</button>

                      </form>
                            
                  </td>
              </tr>

          </tbody>
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
                显示当前页码是{{$data->currentPage()}} 从{{$data->firstItem()}} to {{$data->lastItem()}} 一共{{$data->total()}}条数据
            </div>
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
                
                {{$data->appends($request->all())->links()}}

            </div>   
        </div>
    </div>
</div>
    
@stop

<!-- 右侧内容框架，更改从这里结束 -->
@section('js')
<script>
    $('.mws-form-message').delay(2000).fadeOut(2000);
</script>
@stop


