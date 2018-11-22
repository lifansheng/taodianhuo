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
            <tr>
                <td>{{$v['id']}}</td>
                <td>{{$v['title']}}</td>
                <td><img src="{{$v->pic}}" style="width: 80px;height: 80px;"></td>
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
        </div>
    </div>
</div>
    


<!-- 右侧内容框架，更改从这里结束 -->
@endsection


