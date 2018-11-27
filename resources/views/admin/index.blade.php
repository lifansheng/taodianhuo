@extends('layout.admins')

@section('title',$title)

@section('content')
    
    <h2>现在是北京时间:</h2>
    <p id='times' style='font-size:20px;color:blue'></p>


@stop
@section('js')
<script>
        setInterval(function(){

        var d = new Date();
        //获取年
        var y = d.getFullYear();

        //获取月
        var m = d.getMonth()+1;
        if(m < 10){

            m = '0'+m;
        }
        //获取日
        var ds = d.getDate();
        if(ds < 10){

            ds = '0'+ds;
        }

        //获取时
        var h = d.getHours();
        if(h < 10){

            h = '0'+h;
        }

        //获取分
        var ms = d.getMinutes();
        if(ms < 10){

            ms = '0'+ms;
        }

        //获取秒
        var s = d.getSeconds();
        if(s < 10){

            s = '0'+s;
        }

        //获取星期
        var day = d.getDay();

        switch(day){
            case 1:
                day = '星期一';
            break;
            case 2:
                day = '星期二';
            break;
            case 3:
                day = '星期三';
            break;
            case 4:
                day = '星期四';
            break;
            case 5:
                day = '星期五';
            break;
            case 6:
                day = '星期六';
            break;
            case 0:
                day = '星期日';
            break;
        }

        //2018-10-12 10:02:34 星期五

        $('#times').text(y+'-'+m+'-'+ds+' '+h+':'+ms+':'+s+' '+day);

        },1000)
</script>
@stop