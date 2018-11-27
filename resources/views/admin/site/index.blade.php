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
          
            <div class="dataTables_filter" id="DataTables_Table_1_filter">
               

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
                    

                      </form>
                            
                  </td>
              </tr>

          </tbody>
        
               
                </tbody>
            </table>
           
          
            <div class="dataTables_paginate paging_full_numbers" id="DataTables_Table_1_paginate">
               

            </div>   
        </div>
    </div>
</div>
    
@stop

<!-- 右侧内容框架，更改从这里结束 -->
@section('js')

@stop


