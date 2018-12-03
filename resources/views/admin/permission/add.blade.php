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
        <form class="mws-form" action="/admin/permission" method="post">
            {{csrf_field()}}
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限路径名</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="url_name">
                    </div>
                </div>
            </div class="mws-form-inline">
            <div class="mws-form-inline">
                <div class="mws-form-row">
                    <label class="mws-form-label">权限路径</label>
                    <div class="mws-form-item">
                        <input class="small" type="text" name="url">
                    </div>
                </div>
            </div class="mws-form-inline">
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