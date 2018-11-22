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

            <form action="/admin/cate/{{$res->id}}" method="post" class="mws-form">
                <div class="mws-form-inline">
                    <div class="mws-form-row">
                        <label class="mws-form-label">分类名</label>
                        <div class="mws-form-item">
                            <input type="text" class="small" name='title' value="{{$res->title}}">
                        </div>
                    </div>
                  
                   <div class="mws-form-row">
                        <label class="mws-form-label">顶级分类</label>
                        <div class="mws-form-item">
                            <select class="small" name='pid' disabled>

                                <option value='0'>请选择</option>
                         
                                    @foreach($rs as $v)

                                     @if($res->pid == $v->id)
                                    <option value='{{$v->id}}' selected>{{$v->title}}</option>
                                    @else
                                    <option value='{{$v->id}}'>{{$v->title}}</option> 
                                    @endif                                       
                                    @endforeach
                               
                            </select>
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