@extends("layout.admins")

@section("title", $title)

@section("content")
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
        <form class="mws-form" action="/admin/do_role_per?id={{$res->id}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">角色名：</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="role_name" value="{{$res->role_name}}">
                    </div>
                </div>
            </div>
            <!-- <button id="all">全选</button> -->
            <div class="mws-form-row bordered">
                <label class="mws-form-label">权限路径名：</label>
                <div class="mws-form-item clearfix">
                    <ul class="mws-form-list inline">
                        @foreach($per as $k=>$v)
                            @if(in_array($v->id,$info))
                            <li>
                                <label><input type="checkbox" name='per_id[]' value='{{$v->id}}' checked>{{$v->url_name}}&nbsp;&nbsp;&nbsp;|||&nbsp;&nbsp;&nbsp;</label>
                            </li>
                            @else
                            <li>
                                <label><input type="checkbox" name='per_id[]' value='{{$v->id}}'>{{$v->url_name}}&nbsp;&nbsp;&nbsp;|||&nbsp;&nbsp;&nbsp;</label>
                            </li>
                            @endif
                        @endforeach
                    </ul>
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

    /*$("#all").click(function{
        // $("input[type=checkbox]").attr("checked", true);
        alert($);
    })*/
</script>
@stop