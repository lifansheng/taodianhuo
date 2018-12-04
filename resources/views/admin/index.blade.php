@extends('layout.admins')

@section('title',$title)
<style type="text/css">
* {
    margin: 0;
    padding: 0
}

body {
    background-color: #e8e3da;
}

ul {
    list-style: none
}

#wrap {
    width: 980px;
    height: 500px;
}

#wrap li {
    position: absolute;
    left: 0;
    top: 0;
    transition: transform 1500ms ease-out;
    background-color: white;
}

.box {
    width: 100%;
    height: 100%;
    background-size: cover;
    transition: transform 1500ms ease-out;
}

.center {
    margin: auto;
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;

}
</style>
<script type="text/javascript" src="js/jquery.min.js"></script>
@section('content')
    

<ul id="wrap" class="center" style="margin-top: 80px;" ></ul>


@stop


@section('js')
<script type="text/javascript">
$(function () {
    var collums = 5;//列
    var rows = 5;//行
    var wrap = $('#wrap');
    var w = wrap.width() / rows;
    var h = wrap.height() / collums;


    for (var r = 0; r < rows; r++) {
        for (var c = 0; c < collums; c++) {

            $('<li><div class="box"></div></li>').width(w).height(h)
                    .css({
                        'left': w * c + 'px',
                        'top': h * r + 'px',
                        'transform': 'scale(0.9) rotate(' + (Math.random() * 40 - 20) + 'deg) ' +
                        'translateX(' + (30*c-60) + 'px)' +
                        'translateY(' + (30*r-60) + 'px)'
                    })
                    .find('.box')
                    .css({
                        'background-image': 'url(/admins/shouye/images/' + (r * collums + c) + '.jpg)',
                        'transform': 'scale(0.9)'
                    })
                    .end()
                    .appendTo(wrap)
        }
    }

    var change = true;
    wrap.find('li').on('click', function () {
        if (change == true) {
            var bgImg = $(this).find('div').css('background-image');
            var bgLeft = 0;
            var bgTop = 0;
            $('#wrap li').each(function (index) {
                var $this=$(this);
                $(this).delay(40*index).animate({"opacity":0},200, function () {
                    $this.css({
                        'transform': ' rotate(0deg) ' +
                        'translateX(0)' +
                        'translateY(0)'
                    });
                    $this.find('div').css({
                        'background-image': bgImg,
                        'background-size': 'auto',
                        'backgroundPositionX': -bgLeft,
                        'backgroundPositionY': -bgTop,
                        'transform': 'scale(1)'
                    });
                    bgLeft += 196;
                    if (bgLeft >= 980) {
                        bgTop += 100;
                        bgLeft = 0;
                    }
                    $this.animate({"opacity":1},300);
                })




            });
            change = false;

        } else if (change == false) {

            $('#wrap li').each(function (index) {
                var c=index %collums;
                var r=parseInt(index/collums);
                var $this=$(this);
                $(this).delay(40*index).animate({"opacity":0},200, function () {
                    $this.css({
                        'transform': 'rotate(' + (Math.random() * 40 - 20) + 'deg)' +
                        'translateX(' + (30*c-60) + 'px)' +
                        'translateY(' + (30*r-60) + 'px)'
                    });
                    $this.find('div').css({
                        'background-image': 'url(/admins/shouye/images/' + index + '.jpg)',
                        'background-size': 'cover',
                        'transform': 'scale(0.9)'
                    });
                    $this.animate({"opacity":1},200);
                })

            });
            change = true;
        }
    })
})
</script>
@stop